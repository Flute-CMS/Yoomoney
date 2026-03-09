<?php

namespace Flute\Modules\Yoomoney\ServiceProviders;

use Flute\Core\Support\ModuleServiceProvider;
use Flute\Core\Modules\Payments\Events\RegisterPaymentFactoriesEvent;
use Flute\Modules\Yoomoney\Listeners\PaymentListener;
use Flute\Core\Modules\Payments\Factories\PaymentDriverFactory;
use Flute\Modules\Yoomoney\Omnipay\YoomoneyDriver;

class YoomoneyServiceProvider extends ModuleServiceProvider
{
    public array $extensions = [];

    public function boot(\DI\Container $container): void
    {
        $this->bootstrapModule();
        $this->loadViews('Resources/views', 'flute-yoomoney');
        app(PaymentDriverFactory::class)->register('Yoomoney', YoomoneyDriver::class);
        events()->addDeferredListener(RegisterPaymentFactoriesEvent::NAME, [PaymentListener::class, 'registerYoomoney']);
    }

    public function register(\DI\Container $container): void
    {
    }
}