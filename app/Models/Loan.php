<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = "loans";

    protected $fillable = [
        'status',
        'loan_start_date',
        'loan_expiration_date',
        'loan_real_end_date',
        'fk_copy',
        'fk_user',
    ];

    /**
     * relazione loan-copy
     */
    public function copy()
    {
        return $this->belongsTo(Copy::class, 'fk_copy');
    }

    /**
     * relazione loan-user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user');
    }
}
