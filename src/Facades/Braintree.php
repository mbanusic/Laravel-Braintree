<?php

declare(strict_types=1);

namespace Danhunsaker\Braintree\Facades;

use Illuminate\Support\Facades\Facade;

class Braintree extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'braintree';
    }
}
