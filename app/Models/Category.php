<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name',
        'description'
    ];



    /**
     * relazione category-book (one to many)
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'fk_category');
    }
}
