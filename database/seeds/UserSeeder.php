<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email'=>'sht@gmail.com',
            'name'=>'Saul Hernandez',
            'password'=>Hash::make('sht')
        ]);
        User::create([
            'email'=>'ght@gmail.com',
            'name'=>'Guty Hernandez',
            'password'=>Hash::make('ght')
        ]);
    }
}
