<?php

namespace EolabsIo\YotpoApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\YotpoApi\Domain\Storefront\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->randomNumber(8),
            'display_name' => $this->faker->name(),
            'social_image' => $this->faker->url,
            'user_type' => 'User',
            'is_social_connected' => $this->faker->boolean(),
        ];
    }
}
