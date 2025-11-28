<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Ini auto-increment primary key (id, bukan id_product)
            $table->string('code')->unique();
            $table->string('name');
            $table->enum('category', ['Batik Tulis', 'Batik Cap', 'Batik Printing']);
            $table->integer('price');
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
