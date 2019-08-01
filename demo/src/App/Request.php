<?php
namespace Vendor\Hello;

use Yii;

final class Request implements RequestInterface
{
    public function validate(): bool
    {
        return true;
    }

    public function get(string $key)
    {
        return Yii::app()->request->getQuery($key, null);
    }
}
