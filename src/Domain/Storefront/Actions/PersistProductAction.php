<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Actions;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\YotpoApi\Domain\Storefront\Models\Product;
use EolabsIo\YotpoApi\Domain\Shared\Actions\BasePersistAction;
use EolabsIo\YotpoApi\Domain\Shared\Concerns\FormatsModelAttributes;
use EolabsIo\YotpoApi\Domain\Storefront\Events\PersistedProductEvent;
use EolabsIo\YotpoApi\Domain\Storefront\Actions\AttachSocialLinkAction;

class PersistProductAction extends BasePersistAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'response.products';
    }

    protected function createItem($list): Model
    {
        $values = $this->getFormatedAttributes($list, new Product);
        $attributes = ['id' => data_get($list, 'id')];

        $product = Product::firstOrNew($attributes, $values);

        foreach ($this->associateActions() as $associateActions) {
            (new $associateActions($list))->execute($product);
        }

        $product->push();

        foreach ($this->attachActions() as $attachActions) {
            (new $attachActions($list))->execute($product);
        }

        return $product;
    }

    protected function associateActions(): array
    {
        return [];
    }

    protected function attachActions(): array
    {
        return [
            AttachSocialLinkAction::class,
        ];
    }

    public function getPersistedEvent()
    {
        return PersistedProductEvent::class;
    }
}
