<?php

namespace EolabsIo\YotpoApi\Domain\Shared\Actions;

abstract class BaseAttachAction
{

    /** @var array */
    protected $list;

    protected $model;

    public function __construct($list)
    {
        $key = $this->getKey();
        $this->list = data_get($list, $key, []);
    }

    abstract public function getKey(): string;

    public function execute($model)
    {
        $this->model = $model;
        $this->beforeCreateFromList();
        $this->createFromList();
    }

    public function beforeCreateFromList()
    {
    }

    protected function createFromList()
    {
        foreach ($this->list as $key => $value) {
            $this->createItem($value, $key);
        }
    }

    // protected function createFromList()
    // {
    //     foreach ($this->list as $value) {
    //         $model = $this->createItem($value);
    //         $this->applyAssociateActions($value, $model);
    //         $model->push();
    //         $this->applyAtachActions($value, $model);
    //     }
    // }

    abstract protected function createItem($list, $key);

    public function applyAssociateActions($list, $model)
    {
        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($model);
        }
    }

    protected function associateActions(): array
    {
        return [];
    }

    public function applyAtachActions($list, $model)
    {
        foreach ($this->attachActions() as $attachAction) {
            (new $attachAction($list))->execute($model);
        }
    }

    protected function attachActions(): array
    {
        return [];
    }
}
