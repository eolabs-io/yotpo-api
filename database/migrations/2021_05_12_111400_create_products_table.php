<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\YotpoApi\Domain\Shared\Migrations\YotpoMigration;

class CreateProductsTable extends YotpoMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('domain_key');
            $table->string('name');
            $table->string('embedded_widget_link');
            $table->string('testimonials_product_link');
            $table->string('product_link');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('products');
    }
}
