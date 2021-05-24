<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use EolabsIo\YotpoApi\Domain\Shared\Migrations\YotpoMigration;

class AddYotpoStatusToReviewsTable extends YotpoMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('review_status_id')->nullable();

            $table->foreign('review_status_id')->references('id')->on('review_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function ($table) {
            $table->dropColumn('review_status_id');
        });
    }
}
