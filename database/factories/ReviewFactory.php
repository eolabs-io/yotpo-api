<?php

namespace EolabsIo\YotpoApi\Database\Factories;

use EolabsIo\YotpoApi\Domain\Storefront\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\YotpoApi\Domain\Storefront\Models\User;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Review;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Product;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(8),
            'score' => $this->faker->numberBetween(1, 5),
            'votes_up' => $this->faker->numberBetween(0, 5),
            'votes_down' => $this->faker->numberBetween(0, 5),
            'content' => $this->faker->text(),
            'title' => $this->faker->text(),
            'sentiment' => $this->faker->randomFloat(4),
            'created_at' => $this->faker->dateTime(),
            'verified_buyer' => $this->faker->boolean(),
            'source_review_id' => $this->faker->randomNumber(),
            'custom_fields' => $this->faker->text(),
            'product_id' => Product::factory(),
            'deleted' => $this->faker->boolean(10),
            'user_id' => User::factory(),
            'comment_id' => Comment::factory(),
        ];
    }
}
