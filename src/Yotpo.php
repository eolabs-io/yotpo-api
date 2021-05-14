<?php

namespace EolabsIo\YotpoApi;

class Yotpo
{
    /**
     * Indicates if Yotpo migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = false;


    /**
     * Configure Yotpo to not register its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static;
    }

    /**
     * Configure Yotpo to register its migrations.
     *
     * @return static
     */
    public static function shouldRunMigrations()
    {
        static::$runsMigrations = true;

        return new static;
    }
}
