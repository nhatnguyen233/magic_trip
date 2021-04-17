<?php

namespace Database\Seeders;

use App\Models\Host;
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

        $user_host = User::create([
            'name' => 'host',
            'phone' => '9876543210',
            'email' => 'host@example.com',
            'password' => '123456',
            'address' => 'Quận 1, TP. Hồ Chí Minh',
            'role_id' => 2,
            'payment_id' => 2,
        ]);

        $host = Host::create([
            'host_name' => 'Công ty du lịch Minh Đức',
            'host_mail' => 'minhduc@example.com',
            'hotline' => '0966678983',
            'description' => 'Công ty hàng đầu trong lĩnh vực du lịch và dịch vụ',
            'address' => 'Số 9 ngõ 1/267 Đường Hồ Tùng Mậu - Cầu Diễn - Quận, Nam Từ Liêm',
            'date_of_establish' => '2021-04-20',
            'country_id' => 1,
            'user_id' => $user_host->id,
            'status' => 0
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
