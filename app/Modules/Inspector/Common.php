<?php

declare(strict_types=1);

namespace App\Modules\Inspector;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\RandomPhraseGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

trait Common
{
    public function setUpInspector(): void
    {
        ray()->disable();
        Artisan::call('migrate:fresh', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
    }

    /** @test */
    public function inspectorRequest(): void
    {
        $request = Request::create('/inspector');
        Route::dispatch($request);
    }

    /** @test */
    public function inspectorCommand(): void
    {
        Artisan::call('inspector:test');
    }

    /** @test */
    public function inspectorQueries(): void
    {
        // Multiple queries: list users with post counts
        $users = User::withCount('posts')->orderBy('name')->get();

        foreach ($users->take(3) as $user) {
            // Load posts for each user — demonstrates N+1 pattern
            $user->posts()->where('status', 'published')->get();
        }
    }

    /** @test */
    public function inspectorRelationships(): void
    {
        // Eager loading with nested relations
        $posts = Post::with(['user', 'comments.user'])
            ->where('status', 'published')
            ->latest()
            ->limit(10)
            ->get();

        // Aggregate query
        $stats = DB::table('posts')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();
    }

    /** @test */
    public function inspectorTransaction(RandomPhraseGenerator $generator): void
    {
        DB::transaction(function () use ($generator) {
            $user = User::first();

            $post = Post::create([
                'user_id' => $user->id,
                'title' => $generator->generate('Inspector'),
                'body' => $generator->generate('Transaction'),
                'status' => 'published',
            ]);

            Comment::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
                'body' => $generator->generate('Comment'),
            ]);

            // Update user's latest activity
            $user->update(['updated_at' => now()]);
        });
    }

    /** @test */
    public function inspectorSlowQuery(): void
    {
        // Simulate complex query with joins and subqueries
        $result = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select(
                'users.name',
                'posts.title',
                DB::raw('count(comments.id) as comment_count'),
                DB::raw('max(comments.created_at) as last_comment_at'),
            )
            ->where('posts.status', 'published')
            ->groupBy('users.name', 'posts.title', 'posts.id')
            ->orderByDesc('comment_count')
            ->limit(20)
            ->get();
    }
}
