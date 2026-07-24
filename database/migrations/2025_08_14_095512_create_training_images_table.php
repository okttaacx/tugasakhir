<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Buat tabel training_images untuk menyimpan multiple gambar
        Schema::create('training_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->constrained('trainings')->onDelete('cascade');
            $table->string('image_path');
            $table->boolean('is_primary')->default(false); // Untuk menandai gambar utama
            $table->integer('sort_order')->default(0); // Untuk sorting gambar
            $table->timestamps();
        });

        // Migrasi data gambar yang sudah ada dari tabel trainings ke training_images
        $trainings = DB::table('trainings')->whereNotNull('image')->get();
        foreach ($trainings as $training) {
            DB::table('training_images')->insert([
                'training_id' => $training->id,
                'image_path' => $training->image,
                'is_primary' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Hapus kolom image dari tabel trainings (opsional)
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan data gambar ke tabel trainings sebelum menghapus tabel training_images
        $trainingImages = DB::table('training_images')->where('is_primary', true)->get();
        foreach ($trainingImages as $image) {
            DB::table('trainings')
                ->where('id', $image->training_id)
                ->update(['image' => $image->image_path]);
        }

        Schema::dropIfExists('training_images');

        // Tambahkan kembali kolom image jika sudah dihapus
        Schema::table('trainings', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }
};