<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Bastian Admin',
            'email' => 'babas123@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // data dummy for company
        \App\Models\Company::create([
            'name' => 'Perpustakaan dan Galeri Kota Bogor',
            'email' => 'sebastiangugun@gmail.com',
            'address' => 'Sukajadi, Kec. Tamansari, Kabupaten Bogor, Jawa Barat 16610',
            'latitude' => '-6.648384',
            'longitude' => '106.722253',
            'radius_km' => '4',
            'time_in' => '08:00',
            'time_out' => '15:00',
        ]);

        $this->call([
            AttendanceSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}