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
            'email' => 'test@example.com',
        ]);

        $sheetMusic = SheetMusic::create([
            'title' => 'Amparito Roca',
            'author' => 'Jaume Texidor',
            'file_path' => 'files/amparito.pdf',
        ]);

        $tag = Tag::create([
            'name' => 'Pasodoble',
        ]);

        $sheetMusic->tags()->attach($tag->id);
        Tag::create([
            'name' => 'Clásica',
        ]);

        SheetMusic::create([
            'title' => 'Amparito Roca pero en png',
            'author' => 'Jaume Texidor',
            'file_path' => 'files/amparito.png',
        ]);

        SheetMusic::create([
            'title' => 'Final Fantasy theme',
            'author' => 'Nobuo Uematsu',
            'file_path' => 'files/finalFantasy.png',
        ]);

        SheetMusic::create([
            'title' => 'Final Fantasy IV Love',
            'author' => 'Nobuo Uematsu',
            'file_path' => 'files/ffLove.png',
        ]);
    }
}
