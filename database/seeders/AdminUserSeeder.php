<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a default admin user
        AdminUser::create([
            'username' => 'admin',
            'email' => 'admin@luxuria.com',
            'password' => Hash::make('password123'), // Remember to hash passwords!
            'role' => 'admin',
        ]);
    }
}
