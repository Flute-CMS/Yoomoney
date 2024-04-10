<?php

namespace Flute\Modules\Yoomoney\ServiceProviders;

use Flute\Core\Payments\Events\RegisterPaymentFactoriesEvent;
use Flute\Core\Support\ModuleServiceProvider;
use Flute\Modules\Yoomoney\Listeners\PaymentListener;

class YoomoneyServiceProvider extends ModuleServiceProvider
{
    public array $extensions = [];

    public function boot(\DI\Container $container): void
    {
        events()->addDeferredListener(RegisterPaymentFactoriesEvent::NAME, [PaymentListener::class, 'registerYoomoney']);
    }

    public function register(\DI\Container $container): void
    {
    }
}