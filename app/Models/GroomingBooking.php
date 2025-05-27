<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroomingBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service',
        'date',
        'time',
        'petName',
        'petType',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}