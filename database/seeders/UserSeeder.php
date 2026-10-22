<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('users')->insert([
      [
        'name' => 'Ahmad Fauzi',
        'email' => 'ahmad.fauzi@example.com',
        'email_verified_at' => Carbon::now(),
        'password' => Hash::make('password123'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'name' => 'Siti Nurhaliza',
        'email' => 'siti.nurhaliza@example.com',
        'email_verified_at' => Carbon::now(),
        'password' => Hash::make('password123'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'name' => 'Budi Santoso',
        'email' => 'budi.santoso@example.com',
        'email_verified_at' => null,
        'password' => Hash::make('password123'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'name' => 'Dewi Lestari',
        'email' => 'dewi.lestari@example.com',
        'email_verified_at' => Carbon::now(),
        'password' => Hash::make('password123'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'name' => 'Rizky Pratama',
        'email' => 'rizky.pratama@example.com',
        'email_verified_at' => null,
        'password' => Hash::make('password123'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
    ]);
  }
}
