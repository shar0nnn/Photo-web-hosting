<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser = Role::create(['name' => 'user']);

        $userAdmin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        $userUser1 = User::factory()->create([
            'name' => 'Anton',
            'email' => 'anton@gmail.com',
            'password' => Hash::make('anton123'),
        ]);

        $userUser2 = User::factory()->create([
            'name' => 'Nazar',
            'email' => 'nazar@gmail.com',
            'password' => Hash::make('nazar123'),
        ]);

        $userUser3 = User::factory()->create([
            'name' => 'Cringe',
            'email' => 'cringe@gmail.com',
            'password' => Hash::make('cringe123'),
        ]);

        $userAdmin->assignRole($roleAdmin);
        $userUser1->assignRole($roleUser);
        $userUser2->assignRole($roleUser);
        $userUser3->assignRole($roleUser);
    }
}
