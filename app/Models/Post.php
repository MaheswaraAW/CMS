<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
    	'title',
    	'thumbnail',
    	'name',
    	'content',
    	'is_headline',
    	'status',
    ];

    public static $rules = [
    	'title' => 'required',
    	'thumbnail' => 'required',
        'name' => 'required',
    	'content' => 'required',
    	'is_headline' => 'required',
    	'status' => 'required',
        
    ];
}
