<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * The name of the factory's
    corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'country_id' => Country::find(rand(1,10)),
            'postal_code' => fake()->postcode(),
            'city' => fake()->city(),
            'address' => fake()->streetAddress(),
            'contact_name' => fake()->name(),
            'contact_phone' => fake()->phoneNumber(),
            'address_type' => fake()->randomElement(['individual', 'legal'])
        ];
    }
}
