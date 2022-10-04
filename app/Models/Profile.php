<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
    	'name',
    	'short_description',
    	'photo',
    	'content',
    ];

    public static $rules = [
    	'name' => 'required',
    	'short_description' => 'required',
    	'photo' => 'required',
    	'content' => 'required'
    ];
}
