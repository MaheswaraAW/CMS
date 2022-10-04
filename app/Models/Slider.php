<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'slider';

    protected $fillable = [
    	'title',
    	'image',
    	// 'url',
    	// 'order',
    	'status',
        'name',
    ];

    public static $rules = [
    	'title' => 'required',
    	'image' => 'required',
    	// 'url' => 'required',
    	// 'order' => 'required',
    	'status' => 'required',
        'name' => 'required'
    ];
}
