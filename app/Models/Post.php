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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function meta()
    {
        return $this->hasOne(PostMeta::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
