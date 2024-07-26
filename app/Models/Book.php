<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;
    // protected $table = 'books';
    protected $fillable = [

        'title',
        'thumbnail',
        'author',
        'publisher',
        'Publication',
        'Price',
        'Quantity',
        'category_id'
    ];
    
    // public function category(){
    //     return $this->belongsTo(Category::class);
    // }
    public function category():BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
