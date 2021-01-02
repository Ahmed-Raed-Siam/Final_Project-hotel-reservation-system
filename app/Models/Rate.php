<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory, HasTimestamps;

    /**
     * @var array
     */
    protected $fillable = [
        'value',
        'room_type_id',
        'is_weekend',
    ];
}
