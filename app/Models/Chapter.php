<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'name',
        'slug',
        'description',
        'content',
        'active'
    ];

    public function books(){
        return $this->hasOne(Book::class, 'id', 'book_id')->withDefault(['name' => '']);
    }
}
