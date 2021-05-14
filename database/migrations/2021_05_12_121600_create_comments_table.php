<?php

use Illuminate\Database\Schema\Blueprint;
use EolabsIo\YotpoApi\Domain\Shared\Migrations\YotpoMigration;

class CreateCommentsTable extends YotpoMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('content');
            $table->dateTime('created_at');
            $table->string('comments_avatar')->nullable();

            // $table->timestamps();
            $table->timestamp('model_created_at')->nullable();
            $table->timestamp('model_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists('comments');
    }
}
