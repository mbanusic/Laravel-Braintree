<?php

declare(strict_types=1);

namespace Danhunsaker\Braintree;

use Braintree\Configuration;
use Illuminate\Support\Arr;
use InvalidArgumentException;

class BraintreeFactory
{
    /**
     * Make a new Braintree client.
     *
     * @param array $config
     *
     * @return \Danhunsaker\Braintree\Braintree
     */
    public function make(array $config): Braintree
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = ['environment', 'merchant_id', 'public_key', 'private_key'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return Arr::only($config, ['environment', 'merchant_id', 'public_key', 'private_key']);
    }

    /**
     * Get the Braintree client.
     *
     * @param array $auth
     *
     * @return \Danhunsaker\Braintree\Braintree
     */
    protected function getClient(array $auth): Braintree
    {
        Configuration::environment($auth['environment']);
        Configuration::merchantId($auth['merchant_id']);
        Configuration::publicKey($auth['public_key']);
        Configuration::privateKey($auth['private_key']);

        return new Braintree();
    }
}
