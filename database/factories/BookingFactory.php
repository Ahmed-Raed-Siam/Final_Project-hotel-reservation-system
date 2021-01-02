<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Traits\Date;
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
        $rooms = Room::all();
        $rooms_max = DB::table('rooms')->max('id');
        $date = now();
        $startingDate = $date;
        $endingDate = $date->addWeeks(2);

        return [
            'room_id' => $rooms,
            'start' => $startingDate,
            'end' => $endingDate,
            'is_reservation' => $this->faker->boolean(),
            'is_paid' => $this->faker->boolean(),
            'notes' => $this->faker->sentences,
        ];
    }
}


/*'room_id' => $rooms,
            'start' => $startingDate,
            'end' => $endingDate,
            'is_reservation' => $this->faker->boolean(),
            'is_paid' => $this->faker->boolean(),
            'notes' => $this->faker->sentences,*/
