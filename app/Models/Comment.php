<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';

    protected $fillable = [
        'id_post',
        'name',
    	'email',
    	'comment',
    ];

    public static $rules = [
    	'id_post' =>'required',
        'name' => 'required',
    	'email' => 'required',
    	'comment' => 'required'
    ];
}
