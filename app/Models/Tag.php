<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tag_name'];


    /**
     * The notes that belong to the tag.
     */
    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }
}
