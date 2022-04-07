<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'book_id'
    ];

    protected $table = 'category_book';

}
