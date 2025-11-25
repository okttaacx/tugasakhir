<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // null jika guest
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->date('visit_date');
            $table->string('session_token')->nullable(); // untuk tracking session login
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Index untuk optimasi query
            $table->index(['user_id', 'visit_date']);
            $table->index(['ip_address', 'visit_date']);
            $table->index('session_token');
        });
    }

    public function down()
    {
        Schema::dropIfExists('visits');
    }
};
