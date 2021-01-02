<?php

namespace Database\Factories;

use App\Models\Rate;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class RateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
//        $roomTypes = RoomType::all()->sortBy;
        $roomTypes_max = DB::table('room_types')->max('id');
        return [
            'value' => $this->faker->randomNumber(2),
            'room_type_id' => $this->faker->unique()->numberBetween(1, $roomTypes_max),
            'is_weekend' => $this->faker->boolean(),
        ];
    }
}
