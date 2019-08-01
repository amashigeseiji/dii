<?php
namespace Vendor\Hello;

interface RequestInterface
{
    public function validate(): bool;
    public function get(string $key);
}
