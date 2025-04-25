<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBlogImage extends Model
{
    protected $fillable = [
        'blog_id',
        'image_path'
    ];

    public function blog(){
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
}
