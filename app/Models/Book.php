<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author', 'description', 'published_at','category', 'is_available'];

    public function borrowRecords()
    {
        return $this->hasMany(Borrow_record::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function averageRating()
    {
       
        return $this->ratings()->avg('rating');
    }
}
