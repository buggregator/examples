<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $users = User::factory(10)->create();

        $users->each(function (User $user) use ($users) {
            Post::factory(random_int(1, 5))->create([
                'user_id' => $user->id,
            ])->each(function (Post $post) use ($users) {
                Comment::factory(random_int(0, 4))->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                ]);
            });
        });
    }
}
