<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);

        User::create([
            'name' => 'Jose Coba',
            'email' => 'gerencia@consistelec.com',
            'password' => bcrypt('consistelec')
        ])->assignRole('admin');;
    }
}
