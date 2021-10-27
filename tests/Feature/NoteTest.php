<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class NoteTest extends TestCase
{
   
    /** @test */
    public function test_required_fields_for_note()
    {
        $this->json('POST', 'api/add/notes', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "title" => ["The title field is required."],
                    "description" => ["The description field is required."],
                ]
            ]);
    }


    /** @test */
    public function test_note_saved_successfully()
    {
        $tag = Tag::factory()->create([
            "tag_name" => 'Tag '.Str::random(5).rand(1,50)
        ]);

        $noteData = [
            'title' => 'Note Tile '.Str::random(5).rand(1,50),
            'description' => 'Test Description',
            'checkedTags' => [
                $tag->id
            ]
        ];

        $this->json('POST', 'api/add/notes', $noteData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "message" => "Notes Added Successfully!!"
            ]);
    }
}
