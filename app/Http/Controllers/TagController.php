<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
     /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllTags()
    {
        $tags = Tag::get()->toArray();

        return response()->json($tags,200);
    }

    /**
     * @param TagRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTag(TagRequest $request)
    {
        $tag = new Tag();
        $tag->tag_name = $request->get('tagName');
        $tag->save();

        response()->json(['message' => 'Tag Added Successfully'],200);
    }

    /**
     *
     * @param  int  $tagId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTag($tagId)
    {
        $tag = Tag::find($tagId);
                $tag->delete();

        return response()->json(['message' => 'Deleted Tag Successfully'],200);        
    }
}
