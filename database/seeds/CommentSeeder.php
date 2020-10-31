<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'content'=>'Tons k mami',
            'user_id'=>2,
            'post_id'=>1
        ]);
        Comment::create([
            'content'=>'Kiubo',
            'user_id'=>2,
            'post_id'=>1
        ]);
        Comment::create([
            'content'=>'Nel',
            'user_id'=>1,
            'post_id'=>2
        ]);
    }
}
