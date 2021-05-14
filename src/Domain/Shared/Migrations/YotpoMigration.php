<?php

namespace EolabsIo\YotpoApi\Domain\Shared\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

abstract class YotpoMigration extends Migration
{
    /**
     * The database schema.
     *
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    /**
     * Create a new migration instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->schema = Schema::connection($this->getConnection());
    }

    /**
     * Get the migration connection name.
     *
     * @return string|null
     */
    public function getConnection()
    {
        return config('yotpo.database.connection');
    }
}
