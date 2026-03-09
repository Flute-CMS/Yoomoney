<?php

namespace Flute\Modules\Yoomoney\Listeners;

class PaymentListener
{
    public static function registerYoomoney()
    {
        app()->getLoader()->addPsr4('Omnipay\\Yoomoney\\', module_path('Yoomoney', 'Omnipay/'));
        app()->getLoader()->register();
    }
}