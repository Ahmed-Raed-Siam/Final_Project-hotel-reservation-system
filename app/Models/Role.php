<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory,HasTimestamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function scopeByType($query, $roomTypeId = null)
    {
        if (!is_null($roomTypeId)) {
            $query->where('room_type_id', $roomTypeId);
        }
        return $query;
    }

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
//        return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
        return $this->belongsToMany(User::class, 'role_users')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

}
