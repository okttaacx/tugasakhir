<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelaporansTable extends Migration
{
    public function up()
    {
        Schema::create('pelaporans', function (Blueprint $table) {
            $table->id();
            // A. KEADAAN PERUSAHAAN
            $table->string('NamaPengelola');
            $table->string('namaPerusahaan');
            $table->string('alamatPerusahaan');
            $table->string('noTelp');
            $table->string('kodePos');
            $table->string('jenisUsaha');
            $table->string('NamaPemilikPerusahaan');
            $table->string('AlamatPemilikPerusahaan');
            $table->date('PendirianPerusahaan');
            $table->date('PerpindahanPerusahaan');
            $table->string('statusPerusahaan');
            $table->integer('Indonesia');
            $table->integer('LuarIndonesia');
            $table->json('statusKepemilikan')->nullable();
            $table->json('statusPermodalan')->nullable();
            $table->string('Pemodalan');
            $table->string('AsalNegara');

            // Pengurus perusahaan
            $table->json('pengurusPerusahaan')->nullable();

            // B. KEADAAN KETENAGAKERJAAN
            $table->text('waktuKerjaPria')->nullable(); // Diubah dari json ke text, karena data berupa string panjang, bukan struktur JSON

            // Jumlah tenaga kerja (laki-laki, perempuan)
            $table->integer('JumlahTenagaKerjaLaki')->default(0);
            $table->integer('JumlahTenagaKerjaPerempuan')->default(0);
            $table->integer('JumlahTenagaKerja'); // Total

            // Jumlah tenaga kerja disabilitas
            $table->integer('TenagaKerjaDisabilitasLaki')->default(0);
            $table->integer('TenagaKerjaDisabilitasPerempuan')->default(0);

            // Pekerja anak
            $table->integer('PekerjaAnakLaki')->default(0);
            $table->integer('PekerjaAnakPerempuan')->default(0);

            // Tenaga kerja asing
            $table->integer('TenagaKerjaAsingLaki')->default(0);
            $table->integer('TenagaKerjaAsingPerempuan')->default(0);

            // Status tenaga kerja PKWT
            $table->integer('PKWTLaki')->default(0);
            $table->integer('PKWTPerempuan')->default(0);

            // Status tenaga kerja PKWTT
            $table->integer('PKWTTLaki')->default(0);
            $table->integer('PKWTTPerempuan')->default(0);

            $table->string('PengupahanTertinggi');
            $table->string('PengupahanTerendah');
            $table->json('FasillitasKeselamatan')->nullable();
            $table->json('FasilitasKesejahteraan')->nullable();

            // BPJS Kesehatan (laki-laki, perempuan)
            $table->integer('BPJSKesehatanLaki')->default(0);
            $table->integer('BPJSKesehatanPerempuan')->default(0);
            $table->string('ProgramJaminanKesehatan')->default('Tidak')->change();

            // BPJS Ketenagakerjaan (laki-laki, perempuan)
            $table->integer('BPJSKetenagakerjaanLaki')->default(0);
            $table->integer('BPJSKetenagakerjaanPerempuan')->default(0);

            // JKK (laki-laki, perempuan)
            $table->integer('JKKLaki')->default(0);
            $table->integer('JKKPerempuan')->default(0);
            $table->string('ProgramJKK');

            // JHT (laki-laki, perempuan)
            $table->integer('JHTLaki')->default(0);
            $table->integer('JHTPerempuan')->default(0);
            $table->string('ProgramJHT');

            // JKM (laki-laki, perempuan)
            $table->integer('JKMLaki')->default(0);
            $table->integer('JKMPerempuan')->default(0);
            $table->string('ProgramJKM');

            // JP (laki-laki, perempuan)
            $table->integer('JPLaki')->default(0);
            $table->integer('JPPerempuan')->default(0);
            $table->string('ProgramJP');

            // Perangkat Hubungan Industrial
            $table->string('PerangkatHub');
            $table->string('PerangkatHubMemilikiTenagaKerja');

            // PP (Peraturan Perusahaan)
            $table->enum('PP', ['Ada', 'Tidak'])->default('Tidak');
            $table->enum('PPDaftarDisnaker', ['Sudah', 'Belum'])->nullable();

            // PKB (Perjanjian Kerja Bersama)
            $table->enum('PKB', ['Ada', 'Tidak'])->default('Tidak');
            $table->enum('PKBDaftarDisnaker', ['Sudah', 'Belum'])->nullable();

            // LKS Bipartit
            $table->enum('LKSBipartit', ['Ada', 'Tidak'])->default('Tidak');
            $table->enum('LKSBipartitDaftarDisnaker', ['Sudah', 'Belum'])->nullable();

            // Serikat Pekerja/Buruh
            $table->enum('SerikatPekerja', ['Ada', 'Tidak'])->default('Tidak');
            $table->enum('SerikatPekerjaDaftarDisnaker', ['Sudah', 'Belum'])->nullable();

            // Koperasi Pekerja
            $table->enum('KoperasiPekerja', ['Ada', 'Tidak'])->default('Tidak');
            $table->date('KoperasiTanggalBerdiri')->nullable();
            $table->integer('KoperasiAnggotaLaki')->default(0)->nullable();
            $table->integer('KoperasiAnggotaPerempuan')->default(0)->nullable();

            $table->integer('JumlahPenerimaan');
            $table->integer('JumlahBerhenti');
            $table->string('ProgramPelatihan');
            $table->string('ProgramPemagangan');

            // D. TANGGAL LAPOR DAN KEWAJIBAN MELAPOR KEMBALI
            $table->integer('NomorPelaporan');
            $table->integer('TanggalLapor');
            $table->integer('KewajibanLaporKembali');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelaporans');
    }
}
