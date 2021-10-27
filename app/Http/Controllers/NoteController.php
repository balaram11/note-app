<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllNotes()
    {
        $notes = Note::with('tags')->get()->toArray();

        return response()->json($notes,200);
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
