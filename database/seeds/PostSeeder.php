<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title'=>'My first post',
            'user_id' =>1,
            'body'=>'Hola soy nueva en el grupo'
        ]);
        Post::create([
            'title'=>'Equisde',
            'user_id' => 2,
            'body'=>'Medan dinero¿'
        ]);
    }
}
