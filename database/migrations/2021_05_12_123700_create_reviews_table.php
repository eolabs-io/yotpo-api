<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\YotpoApi\Domain\Shared\Migrations\YotpoMigration;

class CreateReviewsTable extends YotpoMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->integer('score');
            $table->integer('votes_up');
            $table->integer('votes_down');
            $table->text('content');
            $table->string('title');
            $table->float('sentiment');
            $table->dateTime('created_at');
            $table->boolean('verified_buyer');
            $table->unsignedBigInteger('source_review_id')->nullable();
            $table->string('custom_fields')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->boolean('deleted');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comment_id')->nullable();

            // $table->timestamps();
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('comment_id')->references('id')->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('reviews');
    }
}
