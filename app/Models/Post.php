<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','excerpt',
    'content','meta_title','meta_description',
    'user_id', 'tag_id',
    'meta_keyword','category','image'];

}
