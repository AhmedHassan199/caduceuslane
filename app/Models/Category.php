<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the authors for the category.
     */

    public function authors()
    {
        return $this->belongsToMany(User::class, 'category_author', 'category_id', 'author_id');
    }
    public function books()
    {
        return $this->hasMany(Book::class, 'category_id');
    }

}
