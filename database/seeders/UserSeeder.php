<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Pastikan role sudah ada sebelum meng-assign ke user
            $adminRole = Role::firstOrCreate(['name' => 'admin']);
            $userRole = Role::firstOrCreate(['name' => 'user']);

            // Buat atau ambil user Admin
            $admin = User::firstOrCreate([
                'email' => 'm.rismanagustianajiz@gmail.com',
            ], [
                'name' => 'Muhammad Risman Agustiansyah Ajiz',
                'password' => Hash::make('12345678'),
            ]);
            $admin->assignRole($adminRole); // Berikan role admin

            // Buat atau ambil user Biasa
            $user = User::firstOrCreate([
                'email' => 'johnsmax15@gmail.com',
            ], [
                'name' => 'Jhons',
                'password' => Hash::make('12345678'),
            ]);
            $user->assignRole($userRole); // Berikan role user
        });
    }
}
