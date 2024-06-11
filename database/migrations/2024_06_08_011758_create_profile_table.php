<?php

use Carbon\Carbon;
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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict');

            $table->unsignedBigInteger('id_murobbi')->nullable();
            $table->foreign('id_murobbi')->references('id')->on('users')->onDelete('restrict');

            $table->string('photo_profile')->nullable();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir')->nullable()->default(Carbon::now());
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->string('amanah')->nullable();
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->text('alamat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};