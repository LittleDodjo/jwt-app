<?php

namespace App\Models\Api\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'room_number',
        'room_floor',
        'short_desc',
        'is_book'
    ];
}
