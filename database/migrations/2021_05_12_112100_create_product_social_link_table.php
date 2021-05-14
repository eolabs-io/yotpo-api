<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\YotpoApi\Domain\Shared\Migrations\YotpoMigration;

class CreateProductSocialLinkTable extends YotpoMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('product_social_link', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('social_link_id');

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('social_link_id')->references('id')->on('social_links');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('product_social_link');
    }
}
