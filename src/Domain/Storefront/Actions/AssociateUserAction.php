<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Actions;

use EolabsIo\YotpoApi\Domain\Storefront\Models\User;
use EolabsIo\YotpoApi\Domain\Shared\Actions\BaseAssociateAction;

class AssociateUserAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'user';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new User);
        $user = $this->model->user->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($user);
        }

        $user->save();

        $this->model->user()->associate($user);
    }

    protected function associateActions(): array
    {
        return [];
    }
}
