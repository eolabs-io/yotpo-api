<?php

namespace EolabsIo\YotpoApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(8),
            'domain_key' => $this->faker->text(),
            'name' => $this->faker->name(),
            'embedded_widget_link' => $this->faker->url,
            'testimonials_product_link' => $this->faker->url,
            'product_link' => $this->faker->url,
        ];
    }
}
