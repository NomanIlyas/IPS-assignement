<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Comment::factory(10)->create();
    }
}
