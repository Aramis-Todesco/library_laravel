<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = "publishers";

    protected $fillable = [
        'name',
        'address',
        'website',
        'email',
    ];


    /**
     * relazione publisher-book (one to many)
     */
    public function books()
    {
        return $this->hasMany(Book::class, 'fk_publisher');
    }
}
