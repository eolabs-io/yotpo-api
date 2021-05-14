<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\YotpoApi\Domain\Shared\Migrations\YotpoMigration;

class CreateImagesDataTable extends YotpoMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('images_data', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('review_id');
            $table->string('thumb_url')->nullable();
            $table->string('original_url')->nullable();

            $table->timestamps();

            $table->foreign('review_id')->references('id')->on('reviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('images_data');
    }
}
