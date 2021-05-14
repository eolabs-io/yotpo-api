<?php
namespace EolabsIo\YotpoApi\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class YotpoModel extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    /**
     * Get the current connection name for the model.
     *
     * @return string|null
     */
    public function getConnectionName()
    {
        return config('yotpo.database.connection') ?? $this->connection;
    }
}
