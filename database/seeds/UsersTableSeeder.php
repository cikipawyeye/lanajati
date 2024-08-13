<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
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
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('admin123'),
                'role'=>'admin',
                'status'=>'active'
            ),
            array(
                'name'=>'Customer',
                'email'=>'customer@gmail.com',
                'password'=>Hash::make('customer123'),
                'role'=>'user',
                'status'=>'active'
            ),
            array(
                'name'=>'owner',
                'email'=>'owner@gmail.com',
                'password'=>Hash::make('owner123'),
                'role'=>'owner',
                'status'=>'active'
            ),
        );
        
        DB::table('users')->insert($data);
    }
}
