<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'content',
        'feature_image'
    ];

    public function detailImages(){
        return $this->hasMany(DetailBlogImage::class, 'blog_id', 'id');
    }
}
