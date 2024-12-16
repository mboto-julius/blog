<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $tags = Tag::all();
        if ($categories->isEmpty() || $tags->isEmpty()) {
            $this->command->info('No categories or tags found. Please seed them first.');
            return;
        }
        $tagIds = range(1, 22);
        for ($i = 1; $i <= 25; $i++) {
            $title = "Post Title $i";
            $post = Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => "This is the content of Post $i.",
                'category_id' => $categories->random()->id, 
            ]);
            $post->tags()->attach(array_rand(array_flip($tagIds), rand(1, 3)));
        }
        $this->command->info('10 posts created successfully and associated with random categories and tags.');
    }
}
