<?php

namespace Flute\Modules\Yoomoney\Omnipay;

use Flute\Core\Modules\Payments\Drivers\AbstractOmnipayDriver;

class YoomoneyDriver extends AbstractOmnipayDriver
{
    public ?string $adapter = 'Yoomoney';
    public ?string $name = 'Yoomoney';
    public ?string $settingsView = 'flute-yoomoney::settings';

    public function getValidationRules(): array
    {
        return [
            'settings__secret'   => ['required', 'string', 'max-str-len:255'],
            'settings__receiver' => ['required', 'string', 'max-str-len:255'],
            'settings__testMode' => ['required', 'boolean'],
        ];
    }
} 