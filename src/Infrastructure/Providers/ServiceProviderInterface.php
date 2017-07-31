<?php

namespace Evans\Infrastructure\Providers;

use Illuminate\Contracts\Container\Container;

interface ServiceProviderInterface
{
    /**
     * Register services
     *
     * @param Container $container
     * @return void
     */
    public function register(Container $container): void;
}
