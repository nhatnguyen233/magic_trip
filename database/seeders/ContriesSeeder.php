<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class ContriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Việt nam',
        ]);
    }
}
