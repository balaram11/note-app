<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Carbon\Carbon;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'tags' => $this->tags,
            'created_at' => Carbon::parse($this->created_at)->format('g:i A Y/m/d'),
        ];
    }
}
