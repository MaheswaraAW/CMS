<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    use HasFactory;

    protected $table = 'mainmenu';

    protected $fillable = [
    	'title',
    	'parent',
    	// 'category',
    	// 'content',
    	// 'file',
    	'url',
    	// 'order',
    	'status',
    ];

    public static $rules = [
    	'title' =>'required',
    	'parent' =>'required',
    	// 'category' =>'required',
    	// 'content' =>'required',
    	// 'file' =>'required',
    	'url' =>'required',
    	// 'order' =>'required',
    	'status' =>'required',
    ];
}
