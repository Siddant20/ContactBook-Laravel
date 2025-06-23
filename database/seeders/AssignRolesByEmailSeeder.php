<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AssignRolesByEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersWithRoles=[
            'siddantshrestha23@gmail.com'=>'admin',
            'test@example.com'=>'user'
        ];
        foreach ($usersWithRoles as $email=>$role){
            $user=User::where('email',$email)->first();

            if ($user){
                $user->assignRole($role);
                 $this->command->info("Assigned role '{$role}' to user '{$email}'");
            } else {
                $this->command->warn("User with email '{$email}' not found.");

            }

        


        }
    }
}
