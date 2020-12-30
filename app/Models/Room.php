<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory, HasTimestamps;

    /**
     * @var array
     */
    protected $fillable = [
        'number',
        'room_type_id',
    ];

    /*    public function scopeByType($query, $roomTypeId = null)
        {
            if (!is_null($roomTypeId)) {
                $query->where('room_type_id', $roomTypeId);
            }
            return $query;
        }*/


    /**
     * @return BelongsTo
     */
    public function roomType(): BelongsTo
    {
//        return $this->belongsTo(RoomType::class,'room_type_id','id');
        return $this->belongsTo(RoomType::class);
    }

    /**
     * @return Model|BelongsTo|object|null
     */
    public function roomType_model()
    {
//        $roomType_name = $this->roomType()->where('id', $this->id)->first();
        $roomType_name=$this->roomType()->first();
//        dd($roomType_name,$this->id);
        return $roomType_name;
    }


}
