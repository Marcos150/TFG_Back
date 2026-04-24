<?php

namespace Database\Seeders;

use App\Models\SheetMusic;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $sheetMusic = SheetMusic::create([
            'title' => 'Amparito Roca',
            'author' => 'Jaume Texidor'
        ]);

        $tag = Tag::create([
            'name' => 'Pasodoble'
        ]);

        $sheetMusic->tags()->attach($tag->id);
    }
}
