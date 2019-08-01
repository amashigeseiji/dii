<?php

use Ray\Di\Di\Inject;
use Ray\Di\Di\Assisted;
use Koriym\Dii\Injectable;
use Vendor\Hello\FooInterface;
use Vendor\Hello\RequestInterface;

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends CController implements Injectable
{
    /**
     * @var FooInterface
     */
    private $foo;

    /**
     * @Inject
     */
    public function setFoo(FooInterface $foo)
    {
        $this->foo = $foo;
    }

    /**
     * Index action is the default action in a controller.
     */
    public function actionIndex()
    {
        echo 'Hello World' . $this->foo->get();
    }

    /**
     * @Assisted({"request"})
     */
    public function actionSearch(string $someKey, RequestInterface $request = null)
    {
        $val = $request->get('someKey');
        echo 'someKey is: ' . ($val ? htmlspecialchars($val) : 'not given.');
    }
}
