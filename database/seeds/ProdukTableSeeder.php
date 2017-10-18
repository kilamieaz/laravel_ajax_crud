<?php

use Illuminate\Database\Seeder;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk')->insert(array(
		   ['id_kategori' => 1 ,'nama_produk' => 'Sabun Badboy', 'harga_jual' => '2000'],
		   ['id_kategori' => 2 ,'nama_produk' => 'Sampo Moonsilk', 'harga_jual' => '6000']
		));
    }
}
