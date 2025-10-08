<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $admin = User::create([
            'name' => 'admin pemeriksa',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user pengguna',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        $user->assignRole('user');
    }
}
