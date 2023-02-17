<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title', 'slug', 'image', 'short_description', 'description', 'meta_title', 
        'meta_description', 'meta_keyword', 'img_alt_text', 'meta_robots_tags', 'status', 'created_by',
    ];

    /**
     * creator of blogs
     * @return App\Models\User::class
     */
    public function user()
    {
        return $this->belongsTo(Admin::class, "created_by");
    }
    
    /**
     * all categories list collection
     * @return App\Models\BlogCategory
     */
    public function categories()
    {
        return $this->hasMany(BlogCategory::class, 'blog_id', 'id');
    }

    /**
     * all categories list collection
     * @return App\Models\BlogCategory
     */
    public function blogCategory()
    {
        return $this->hasMany(BlogCategory::class, 'blog_id', 'id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
