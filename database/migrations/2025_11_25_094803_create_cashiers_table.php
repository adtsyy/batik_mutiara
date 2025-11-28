<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('cashiers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('username')->unique();
        $table->string('password');
        $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('AKTIF');
        $table->timestamps();
    });
}

  
    public function down(): void
    {
        Schema::dropIfExists('cashiers');
    }
};