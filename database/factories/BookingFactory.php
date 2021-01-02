<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
//        $rooms = DB::table('rooms')->get();
        // OR
        $rooms = Room::all()->random();

        $year = random_int(1980, 2030);
        $month = random_int(1, 12);
        $day = random_int(1, 28);

        $date = Carbon::create($year, $month, $day, 0, 0, 0);
        $start = $date->format('Y-m-d H:i:s');
        $end = $date->addWeeks(random_int(1, 52))->format('Y-m-d H:i:s');
        return [
            'room_id' => $rooms,
            'start' => $start,
            'end' => $end,
            'is_reservation' => $this->faker->boolean(),
            'is_paid' => $this->faker->boolean(),
            'notes' => $this->faker->sentences,
        ];
    }
}
