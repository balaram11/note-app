<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\Tag;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory()->count(3)->create();

        Note::factory()
            ->count(7)
            ->hasAttached($tags)
            ->create();
    }
}
