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
        $attributes = ['user_id' => data_get($list, 'user_id')];
        $user = User::updateOrCreate($attributes, $values);

        $this->model->user()->associate($user);
    }
}
