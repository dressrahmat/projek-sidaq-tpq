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
        Schema::create('kemampuan', function (Blueprint $table) {
            $table->id();
            $table->integer('khidmat')->default(0);
            $table->integer('entrepreneur')->default(0);
            $table->integer('operation')->default(0);
            $table->integer('administration')->default(0);
            $table->integer('leadership')->default(0);
            $table->integer('speaking')->default(0);
            $table->integer('mengajar')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kemampuan');
    }
};
