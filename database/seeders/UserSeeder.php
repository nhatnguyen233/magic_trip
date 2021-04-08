<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'user',
            'phone' => '0123456789',
            'email' => 'user@example.com',
            'password' => '123456',
            'address' => 'Hoài Đức, Hà Nội',
            'role_id' => 1,
            'payment_id' => 1,
        ]);

        $host = User::create([
            'name' => 'host',
            'phone' => '9876543210',
            'email' => 'host@example.com',
            'password' => '123456',
            'address' => 'Quận 1, TP. Hồ Chí Minh',
            'role_id' => 2,
            'payment_id' => 2,
        ]);

        $admin = User::create([
            'name' => 'admin',
            'phone' => '1234567890',
            'email' => 'admin@example.com',
            'password' => '123456',
            'address' => 'Đà Nẵng',
            'role_id' => 3,
            'payment_id' => 3,
        ]);
    }
}
