<?php

namespace Database\Factories;

use App\Models\Payment;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     * 
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->sentence(3),
            'card_number'=> $this->faker->randomDigit(12),
            'expire_month' => $this->faker->date('m', Carbon::now()),
            'expire_year' => $this->faker->date('Y', Carbon::now()),
            'security_code' => bcrypt($this->faker->randomDigit(12)),
        ];
    }
}
