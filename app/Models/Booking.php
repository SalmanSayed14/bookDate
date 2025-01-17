<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id', 'booking_date', 'status', 'admin_letter', 'user_letter',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


