<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'category_id'];

    /**
     * get category
     * @return App\Models\Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * get blog
     * @return App\Models\Blog
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

}
