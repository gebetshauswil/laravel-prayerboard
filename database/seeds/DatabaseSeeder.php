<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminUzwil = factory(User::class)->create([
            'email' => 'uzwil@email.ch',
            'password' => Hash::make('12345678')
        ]);
        $adminWil = factory(User::class)->create([
            'email' => 'wil@email.ch',
            'password' => Hash::make('12345678')
        ]);
    }
}
