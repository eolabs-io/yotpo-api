<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Review;
use EolabsIo\YotpoApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\YotpoApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\YotpoApi\Domain\Storefront\Actions\AssociateUserAction;
use EolabsIo\YotpoApi\Domain\Storefront\Events\PersistedReviewEvent;
use EolabsIo\YotpoApi\Domain\Storefront\Actions\AttachImagesDataAction;
use EolabsIo\YotpoApi\Domain\Storefront\Actions\AssociateCommmentAction;

class PersistReviewAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'response.reviews';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Review);
        $attributes = ['id' => data_get($list, 'id')];

        $review = Review::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($review);
        }

        $review->push();

        foreach ($this->attachActions() as $attachActions) {
            (new $attachActions($list))->execute($review);
        }

        return $review;
    }

    protected function associateActions(): array
    {
        return [
            AssociateUserAction::class,
            AssociateCommmentAction::class,
        ];
    }

    protected function attachActions(): array
    {
        return [
            AttachImagesDataAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedReviewEvent::class;
    }
}
