<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::updateOrCreate(
        //     ['email' => 'test@example.com'],
        //     [
        //         'name' => 'Test User',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ]
        // );
        //  User::factory()
        // ->count(6)
        // ->hasContacts(10)
        // ->create();

            $this->call(RolePermissionSeeder::class);
            $this->call(AssignRolesByEmailSeeder::class);
        

        

        
    }
}
