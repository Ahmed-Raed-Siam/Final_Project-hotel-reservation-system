<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes, HasTimestamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'start',
        'end',
        'is_reservation',
        'is_paid',
        'notes',
    ];

    /**
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function users(): BelongsToMany
    {
//        return $this->belongsToMany(User::class, 'bookings_users', 'booking_id', 'user_id')->withTimestamps();
        return $this->belongsToMany(User::class, 'booking_users')->withTimestamps();
    }

    /**
     * @return Model|BelongsTo|object|null
     */
    public function user_model()
    {
//        $reservation_for = $this->users()->where('id', $this->id)->first();
        $reservation_for = $this->users()->first();
//        dd($reservation_for,$this->id);
        return $reservation_for;
    }

}
