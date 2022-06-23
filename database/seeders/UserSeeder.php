<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(2)
            ->state(new Sequence(
                [
                    'name' => 'ROX',
                    'email' => 'webmaster@rox.nl',
                    'password' => bcrypt(config('rox.users.rox')),
                ],
                [
                    'name' => 'Client',
                    'email' => 'test@rox.nl',
                    'password' => bcrypt(config('rox.users.client')),
                ],
            ))
            ->isAdmin()
            ->create();
    }
}
