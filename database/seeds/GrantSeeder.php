<?php

use Illuminate\Database\Seeder;
use App\Grant;

class GrantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grant::create([
            'user_id'=>1,
            'abilities'=>'user:edit'
        ]);
        Grant::create([
            'user_id'=>1,
            'abilities'=>'user:info'
        ]);
        Grant::create([
            'user_id'=>1,
            'abilities'=>'user:perfil'
        ]);
        Grant::create([
            'user_id'=>1,
            'abilities'=>'user:delete'
        ]);
        Grant::create([
            'user_id'=>1,
            'abilities'=>'user:post'
        ]);
        Grant::create([
            'user_id'=>2,
            'abilities'=>'user:info'
        ]);
        Grant::create([
            'user_id'=>2,
            'abilities'=>'user:perfil'
        ]);
        Grant::create([
            'user_id'=>2,
            'abilities'=>'user:post'
        ]);
        Grant::create([
            'user_id'=>3,
            'abilities'=>'user:info'
        ]);
    }
}
