<?php

namespace Database\Factories;

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class RoleUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoleUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random(),
//            'role_id' => Role::all()->random(),
//            'role_id' => Role::all()->max(),
//            'role_id' => $this->faker->unique()->numberBetween(1, Role::max('id')),
            'role_id' => $this->faker->unique()->numberBetween(1, DB::table('roles')->max('id')),
        ];
    }
}
