<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Response;
use App\Models\User;
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
            ResponseSeeder::class
        ]);
    }
}
