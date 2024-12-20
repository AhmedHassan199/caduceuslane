<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'published_at', 'bio', 'cover', 'author_id' ,'category_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get the category of the book (One Book belongs to one Category).
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
