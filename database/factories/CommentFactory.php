<?php

namespace EolabsIo\YotpoApi\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Comment;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(8),
            'content' => $this->faker->text(),
            'created_at' => $this->faker->dateTime(),
            'comments_avatar' => $this->faker->text(),
        ];
    }
}
