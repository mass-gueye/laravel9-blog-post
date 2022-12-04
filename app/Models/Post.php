<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title' ,
        'excerpt' ,
        'min_to_read',
        'body' ,
        'image_url' ,
        'is_published'
    ];
}
