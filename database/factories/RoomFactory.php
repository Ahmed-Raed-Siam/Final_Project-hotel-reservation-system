<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        //$roomTypes = DB::table('room_types')->pluck('id')->all();
        // OR
        //$roomTypes_max=DB::table('room_types')->max('id');
        return [
            'name' => $this->faker->word,
            'number' => $this->faker->unique()->randomNumber(),
//            'room_type_id' => $this->faker->randomElement($roomTypes),
//            'room_type_id' => $this->faker->unique()->numberBetween(1, DB::table('room_types')->max('id')),
//            'room_type_id' => $this->faker->unique()->numberBetween(1, $roomTypes_max),
            'room_type_id' => RoomType::all()->random(),
        ];
    }
}
