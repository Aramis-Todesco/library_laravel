<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = "authors";

    protected $fillable = [
        'email',
        'name',
        'surname',
        'birth_date',
    ];


    /**
     * relazione author-book (many to many)
     */
    public function books()
    {
        return $this->belongsToMany(Book::class,'author_book','fk_author','fk_book');
    }
}
