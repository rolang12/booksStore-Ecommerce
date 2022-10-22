<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->decimal('total',10,2);
            $table->integer('items'); //cantidad de productos diferentes que se venden
            $table->string('paymentway')->default('Cash');
            $table->enum('status', ['PAID','DISPATCHED','CANCELED','RECEIVED'])->default('PAID') ; //cantidad de productos que se venden
            $table->decimal('cash',10,2)->nullable();
            $table->decimal('change',10,2)->nullable();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('sales');
    }
}
