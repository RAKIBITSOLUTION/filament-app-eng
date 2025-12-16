<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['thumbnail', 'title', 'color', 'slug', 'category_id', 'content', 'tags', 'is_published'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $casts = [
        'tags' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
