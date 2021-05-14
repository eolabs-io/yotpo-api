<?php

namespace EolabsIo\YotpoApi\Domain\Storefront\Actions;

use EolabsIo\YotpoApi\Domain\Storefront\Models\SocialLink;
use EolabsIo\YotpoApi\Domain\Shared\Actions\BaseAttachAction;
use EolabsIo\YotpoApi\Domain\Shared\Concerns\FormatsModelAttributes;

class AttachSocialLinkAction extends BaseAttachAction
{
    use FormatsModelAttributes;

    public function getKey(): string
    {
        return 'social_links';
    }

    public function beforeCreateFromList()
    {
        $this->model->socialLinks()->detach();
    }

    protected function createItem($value, $key)
    {
        $values = [
            'platform' => $key,
            'url' => $value,
        ];
        $attributes = $values;

        $imagesData = SocialLink::firstOrCreate($attributes, $values);

        $this->model->socialLinks()->attach($imagesData);
    }
}
