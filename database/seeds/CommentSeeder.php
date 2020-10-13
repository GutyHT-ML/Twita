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
            'post_id'=>1
        ]);
        Comment::create([
            'content'=>'Kiubo',
            'post_id'=>1
        ]);
        Comment::create([
            'content'=>'Nel',
            'post_id'=>2
        ]);
    }
}
