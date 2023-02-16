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

}
