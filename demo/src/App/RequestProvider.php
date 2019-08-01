<?php
namespace Vendor\Hello;

use Ray\Di\ProviderInterface;
use Ray\Di\MethodInvocationProvider;

final class RequestProvider implements ProviderInterface
{

    /**
     * @var MethodInvocationProvider
     */
    private $invocationProvider;

    public function __construct(MethodInvocationProvider $invocationProvider)
    {
        $this->invocationProvider = $invocationProvider;
    }

    public function get()
    {
        $invocation = $this->invocationProvider->get();
        list($someKey) = $invocation->getArguments()->getArrayCopy();
        var_dump($someKey);exit;
        return new Request;
    }
}
