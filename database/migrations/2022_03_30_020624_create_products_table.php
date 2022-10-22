<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->longText('description');
            $table->decimal('price',8,2);
            $table->integer('stock');
            $table->integer('alerts');
            $table->string('editorial',70);
            $table->enum('presentation', ['Tapa Blanda', 'Tapa Dura'])->default('Tapa Blanda') ;
            $table->integer('edition');
            $table->string('language');
            $table->integer('n_pages');
            $table->integer('height');
            $table->integer('width');
            $table->string('year')->nullable();
            $table->string('image');
            $table->string('barcode', 30)->nullable();
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('authors_id')->constrained('authors','id')->onUpdate('cascade')->onDelete('cascade');;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
