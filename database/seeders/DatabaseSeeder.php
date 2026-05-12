<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
        ]);

        User::create([
            'first_name' => 'dek',
            'last_name' => 'adi',
            'email' => 'kadekadi368@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'first_name' => 'dek',
            'last_name' => 'adi',
            'email' => 'kadekadi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user'),
            'role' => 'user',
            'remember_token' => Str::random(10),
        ]);
    }
}
