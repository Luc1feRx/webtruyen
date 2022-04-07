<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'active',
    ];

    public function books(){
        return $this->hasMany(Book::class, 'category_id', 'id');
    }

    public function bookss(){
        return $this->belongsToMany(Book::class, 'category_book', 'category_id', 'book_id');
    }

}
