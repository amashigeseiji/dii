<?php

namespace Koriym\Dii\Module;

use Ray\Di\AbstractModule;
use Vendor\Hello\BarInterceptor;
use Vendor\Hello\Foo;
use Vendor\Hello\FooInterface;
use Vendor\Hello\RequestInterface;
use Vendor\Hello\RequestProvider;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(\SiteController::class);
        $this->bind(FooInterface::class)->to(Foo::class);
        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->startsWith('actionIndex'),
            [BarInterceptor::class]
        );
        $this->bind(RequestInterface::class)->toProvider(RequestProvider::class);
    }
}
