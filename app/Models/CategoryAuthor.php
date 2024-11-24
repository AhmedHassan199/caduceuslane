<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAuthor extends Model
{
    protected $table = 'category_author';
    protected $fillable = ['category_id', 'author_id'];
    use HasFactory;
}
