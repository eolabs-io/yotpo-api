<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\YotpoApi\Domain\Shared\Migrations\YotpoMigration;

class CreateSocialLinksTable extends YotpoMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('social_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('platform');
            $table->string('url');

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
        $this->schema->dropIfExists('social_links');
    }
}
