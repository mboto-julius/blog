<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tags')->insert([
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'Python', 'slug' => 'python'],
            ['name' => 'Java', 'slug' => 'java'],
            ['name' => 'Ruby', 'slug' => 'ruby'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'Swift', 'slug' => 'swift'],
            ['name' => 'Go', 'slug' => 'go'],
            ['name' => 'Rust', 'slug' => 'rust'],
            ['name' => 'TypeScript', 'slug' => 'typescript'],
            ['name' => 'Kotlin', 'slug' => 'kotlin'],
            ['name' => 'Perl', 'slug' => 'perl'],
            ['name' => 'Shell', 'slug' => 'shell'],
            ['name' => 'VHDL', 'slug' => 'vhdl'],
            ['name' => 'Elixir', 'slug' => 'elixir'],
            ['name' => 'Julia', 'slug' => 'julia'],
            ['name' => 'MATLAB', 'slug' => 'matlab'],
            ['name' => 'Assembly', 'slug' => 'assembly'],
            ['name' => 'SQL', 'slug' => 'sql'],
            ['name' => 'HTML', 'slug' => 'html'],
            ['name' => 'CSS', 'slug' => 'css'],
            ['name' => 'Sass', 'slug' => 'sass'],
            ['name' => 'GraphQL', 'slug' => 'graphql']
        ]);
    }
}
