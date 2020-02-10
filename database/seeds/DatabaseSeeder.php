<?php

use App\Enums\UserType;
use App\Role;
use App\User;
use App\Organisation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = factory(User::class)->create([
            'name' => 'Super Administrator',
            'email' => 'superadmin@prayerboard.ch',
            'password' => Hash::make('12345678'),
            'is_superadmin' => true
        ]);

        $admin = factory(User::class)->create([
            'name' => 'Administrator',
            'email' => 'admin@prayerboard.ch',
            'password' => Hash::make('12345678'),
        ]);

        $gebetshausBuelach = factory(Organisation::class)->create([
            'name' => 'Gebetshaus Bülach',
        ]);

        $gebetshausWil = factory(Organisation::class)->create([
            'name' => 'Gebetshaus Wil',
        ]);
        $gebetshausZuerich = factory(Organisation::class)->create([
            'name' => 'Gebetshaus Zürich',
        ]);

        $gebetshausWil->users()->save($admin, ['type' => UserType::Administrator]);
        $gebetshausZuerich->users()->save($admin, ['type' => UserType::Administrator]);
        $gebetshausBuelach->users()->save($admin, ['type' => UserType::Visitor]);
    }
}
