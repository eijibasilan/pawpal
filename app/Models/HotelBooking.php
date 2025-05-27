<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBooking extends Model
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
        'payment_id',
        'payment_status',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}