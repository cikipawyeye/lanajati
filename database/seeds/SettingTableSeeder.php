<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            'description'=>"Lana Jati adalah sebuah toko kerajinan furnitur yang berlokasi di kota Jepara, sebuah kota yang terkenal dengan keahlian tangan mereka dalam membuat furnitur kayu.
             Toko ini telah lama menjadi destinasi utama bagi mereka yang mencari furnitur berkualitas tinggi dengan desain klasik dan modern yang elegan.
              Dengan menggunakan bahan baku kayu jati yang berkualitas dan tenaga ahli yang berpengalaman,
               Lana Jati telah menciptakan berbagai macam produk furnitur yang memadukan keindahan dan fungsionalitas.",
            'short_des'=>"Toko Lana Jati menyediakan berbagai macam produk furnitur, termasuk kursi, meja, lemari, tempat tidur, dan berbagai aksesoris dekorasi lainnya.",
            'photo'=>"logo.png",
            'logo'=>'logo(custom).png',
            'address'=>"jawa tengah, jepara",
            'email'=>"lanajati@gmail.com",
            'phone'=>"+6287816571598",
            
        );
        DB::table('settings')->insert($data);
    }
}
