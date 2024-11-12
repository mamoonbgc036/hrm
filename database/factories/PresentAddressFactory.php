<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Division;
use App\Models\PresentAddress;
use App\Models\Upazila;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresentAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PresentAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "division_id" => rand(1,Division::count()),
            "district_id" => rand(1,District::count()),
            "upazila_id" => rand(1,Upazila::count()),
            "post_office" => $this->faker->name(),
            "postal_code" => rand(1111,9999),
            "area" => $this->faker->name(),
            "u_c_c_w" => $this->faker->name(),
            "house_no" => rand(11,99),
        ];
    }
}
