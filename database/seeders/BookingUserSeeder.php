<?php

namespace Database\Seeders;

use App\Models\BookingUser;
use Illuminate\Database\Seeder;

class BookingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        BookingUser::factory()->count(20)->create();
    }
}
