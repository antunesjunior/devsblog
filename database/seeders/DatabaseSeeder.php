<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            FollowerSeeder::class,
            PostSeeder::class,
            LikeSeeder::class,
            CommentSeeder::class,
            CommentReplySeeder::class
        ]);
    }
}
