<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Actions;

use EolabsIo\YotpoApi\Domain\Storefront\Models\ImagesData;
use EolabsIo\YotpoApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\YotpoApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachImagesDataAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'images_data';
    }

    protected function createItem($list, $key)
    {
        $values = $this->getFormatedAttributes($list, new ImagesData);
        $values['review_id'] = $this->model->id;
        $attributes = $values;

        $imagesData = ImagesData::firstOrCreate($attributes, $values);

        foreach ($this->associateActions() as $associateAction) {
            (new $associateAction($list))->execute($imagesData);
        }

        $imagesData->save();
    }

    protected function associateActions(): array
    {
        return [];
    }
}
