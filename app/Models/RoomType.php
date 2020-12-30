<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use HasFactory, HasTimestamps, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'picture',
    ];

    /**
     * @return HasOne
     */
    public function room(): HasOne
    {
        return $this->hasOne(Room::class);
    }

    /**
     * @return HasMany
     */
    public function rooms(): HasMany
    {
//        return $this->hasMany('App\Room', 'id', 'room_type_id');
//        return $this->hasMany(Room::class,'id','room_type_id');
        return $this->hasMany(Room::class);
    }
}
