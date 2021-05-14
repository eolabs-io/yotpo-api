<?php

namespace EolabsIo\YotpoApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\YotpoApi\Domain\Storefront\Models\SocialLink;

class SocialLinkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SocialLink::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'platform' => $this->faker->randomElement([
                'facebook',
                'twitter',
                'linkedin',
                'google_oauth2',
            ]),
            'url' => $this->faker->url,
        ];
    }
}
