<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagTest extends TestCase
{
    /** @test */
    public function test_tag_name_required()
    {
        $this->json('POST', 'api/add/tag', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "tagName" => ["The tag name field is required."],
                ]
            ]);
    }

    /** @test */
    public function test_tag_created_successfully()
    {
        $tagData = [
            "tagName" => 'Tag '.Str::random(5).rand(1,50),
        ];

        $this->json('POST', 'api/add/tag', $tagData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_tag_deleted_successfully()
    {
        $tag = Tag::factory()->create([
            "tag_name" => 'Tag '.Str::random(5).rand(1,50)
        ]);

        $this->json('DELETE', 'api/delete/tag/' . $tag->id, [], ['Accept' => 'application/json'])
            ->assertStatus(204);
    }

}


