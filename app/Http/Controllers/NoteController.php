<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllNotes()
    {
        $notes = Note::with('tags')->get()->toArray();

        return NoteResource::collection(Note::orderBy('created_at','desc')->get());
    }

    /**
     * @param NoteRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNotes(NoteRequest $request)
    {
        $note = new Note();
        $note->title  = $request->get('title');
        $note->description  = $request->get('description');
        $note->save();

        if(count($request->get('checkedTags')) > 0) $note->tags()->attach($request->get('checkedTags'));

        return response()->json(['message' => 'Notes Added Successfully!!'],200);
    }
}
