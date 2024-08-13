<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            array(
                'code'=>'lanajati18',
                'type'=>'fixed',
                'value'=>'1000',
                'status'=>'active'
            ),
            array(
                'code'=>'lanajati20',
                'type'=>'percent',
                'value'=>'4',
                'status'=>'active'
            ),
        );
        DB::table('coupons')->insert($data);
    }
}
