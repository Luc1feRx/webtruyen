<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected $fillable = [
        'name',
        'slug',
        'summary',
        'description',
        'category_id',
        'thumb',
        'author',
        'hot_book',
        'views',
        'active','created_at', 'updated_at'
    ];

    public function categories(){
        return $this->hasOne(Category::class, 'id', 'category_id')->withDefault(['name' => '']);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class, 'book_id', 'id');
    }

    public function book_in_multiple_cate(){
        return $this->belongsToMany(Category::class, 'category_book', 'book_id', 'category_id');
    }
}
