<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('produk', function(Blueprint $table){
          $table->increments('id_produk');       
          $table->integer('id_kategori');         
          $table->string('nama_produk');            
          $table->integer('harga_jual');            
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
      Schema::drop('produk');
   }
}
