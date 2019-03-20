<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Braintree.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Braintree;

class Braintree
{
    private $braintreeClass;

    public function __call(string $method, array $arguments)
    {
        if (substr($method, 0, 3) == 'get') {
            // Remove the get*-prefix to get a class name
            $sdkClass = substr($method, 3);

            // If method is get*, we will store the last called class
            if (class_exists($apiClass = "Braintree\\$sdkClass")) {
                $this->braintreeClass = $apiClass;
            }
        }
        // A class has been previously called
        elseif ($this->braintreeClass) {
            return forward_static_call_array([$this->braintreeClass, $method], $arguments);
        }

        return $this;
    }
}
