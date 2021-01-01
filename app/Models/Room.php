<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param $query
     * @param null $roomTypeId
     * @return mixed
     */
    public function scopeByType($query, $roomTypeId = null)
    {
        if (!is_null($roomTypeId)) {
            $query->where('room_type_id', $roomTypeId);
        }
        return $query;
    }


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
        $roomType_name = $this->roomType()->first();
//        dd($roomType_name,$this->id);
        return $roomType_name;
    }

    /**
     * @param $start_date
     * @param $end_date
     * @return Collection
     */
    public function getAvailablerooms($start_date, $end_date): Collection
    {
        $available_rooms = DB::table('rooms as r')->select('r.id', 'r.name')->whereRaw(
            "r.id NOT IN(SELECT b.room_id FROM bookings bWHERE NOT(
                                            b.date_out < '{$start_date}' OR
                                            b.date_in > '{$end_date}'))")->orderBy('r.id')->get();
        return $available_rooms;
    }

    public function isRoomBooked($room_id, $start_date, $end_date): int
    {

        $available_rooms = DB::table('bookings')
            ->whereRaw("
                            NOT(
                                end < '{$start_date}' OR
                                start > '{$end_date}'
                                )
                        ")
            ->where('room_id', $room_id)
            ->count();
        return $available_rooms;

    }


}
