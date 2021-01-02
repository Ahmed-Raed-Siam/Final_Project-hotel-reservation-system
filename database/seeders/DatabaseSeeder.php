<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(HotelSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(RoomTypeSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(DiscountSeeder::class);
        /*RateSeeder Should Run Alone After all*/
//        $this->call(RateSeeder::class);
        /*BookingSeeder Should Run Alone After all Not Ready*/
//        $this->call(BookingSeeder::class);
//        $this->call(BookingUserSeeder::class);
    }
}
