<?php

declare(strict_types=1);

namespace Danhunsaker\Braintree;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

class BraintreeManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Danhunsaker\Braintree\BraintreeFactory
     */
    private $factory;

    /**
     * Create a new Braintree manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Danhunsaker\Braintree\BraintreeFactory  $factory
     */
    public function __construct(Repository $config, BraintreeFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config): Braintree
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName(): string
    {
        return 'braintree';
    }

    /**
     * Get the factory instance.
     *
     * @return \Danhunsaker\Braintree\BraintreeFactory
     */
    public function getFactory(): BraintreeFactory
    {
        return $this->factory;
    }
}
