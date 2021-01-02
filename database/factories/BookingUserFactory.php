<?php

namespace Database\Factories;

use App\Models\BookingUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class BookingUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $booking_id = DB::table('bookings')->max('id');
        return [
            'booking_id' => $this->faker->unique()->numberBetween(1, $booking_id),
            'user_id' => User::all()->random(),
        ];
    }
}
