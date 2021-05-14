<?php

namespace EolabsIo\YotpoApi\Domain\Shared\Actions;

use EolabsIo\YotpoApi\Domain\Shared\Concerns\FormatsModelAttributes;

abstract class BaseAssociateAction
{
    use FormatsModelAttributes;

    /** @var array */
    protected $list;

    protected $model;

    public function __construct($list)
    {
        $key = $this->getKey();
        $this->list = data_get($list, $key, null);
    }

    abstract public function getKey(): string;

    public function execute($model)
    {
        $this->model = $model;
        $this->createFromList();
    }

    public function hasNoAttributes(): bool
    {
        return is_null($this->list);
    }

    private function createFromList()
    {
        if ($this->hasNoAttributes()) {
            return;
        }

        $this->createItem($this->list);
    }

    abstract protected function createItem($list);

    public function validateModelId(array $values, string $model): array
    {
        $keyName = (new $model)->getKeyName();
        $keyValue = data_get($values, $keyName);

        if ($keyValue == 0) {
            $values[$keyName] = $model::max($keyName) + 1;
        }

        return $values;
    }
}
