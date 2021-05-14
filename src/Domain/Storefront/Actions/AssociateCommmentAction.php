<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Actions;

use EolabsIo\YotpoApi\Domain\Shared\Actions\BaseAssociateAction;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Comment;

class AssociateCommmentAction extends BaseAssociateAction
{
    public function getKey(): string
    {
        return 'comment';
    }

    protected function createItem($list)
    {
        $values = $this->getFormatedAttributes($list, new Comment);
        $comment = $this->model->comment->fill($values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($comment);
        }

        $comment->save();

        $this->model->comment()->associate($comment);
    }

    protected function associateActions(): array
    {
        return [];
    }
}
