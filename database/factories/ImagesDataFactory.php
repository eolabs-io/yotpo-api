<?php

namespace EolabsIo\YotpoApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\YotpoApi\Domain\Storefront\Models\ImagesData;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Review;

class ImagesDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImagesData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(8),
            'review_id' => Review::factory(),
            'thumb_url' => $this->faker->url,
            'original_url' => $this->faker->url,
        ];
    }
}
