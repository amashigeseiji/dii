<?php

namespace Koriym\Dii;

use CException;
use Ray\Di\Grapher;
use Koriym\Dii\Module\AppModule;
use YiiBase;

/**
 * Ray.Di powered Yii class
 */
class Dii extends YiiBase
{
    /**
     * {@inheritdoc}
     *
     * @throws \ReflectionException
     */
    public static function createComponent($config)
    {
        $args = func_get_args();
        [$type, $config] = self::extract($config);
        if (! class_exists($type, false)) {
            $type = self::import($type, true);
        }
        unset($args[0]);

        $isInjectable = in_array(Injectable::class, class_implements($type), true);
        $object = $isInjectable ? Dii::getGrapher()->newInstanceArgs($type, $args) : (new \ReflectionClass($type))->newInstanceArgs($args);

        foreach ($config as $key => $value) {
            $object->$key = $value;
        }

        return $object;
    }

    /**
     * {@inheritdoc}
     */
    public static function createWebApplication($config = null)
    {
        return self::createApplication(DiiWebApplication::class, $config);
    }

    public static function getGrapher() : Grapher
    {
        $tmpDir = dirname((new \ReflectionClass(AppModule::class))->getFileName()) . '/tmp';

        return new Grapher(new AppModule, $tmpDir);
    }

    /**
     * Extract config
     *
     * @param string|array $config
     *
     * @throws CException
     *
     * @return [$type, $config]
     */
    private static function extract($config) : array
    {
        if (is_string($config)) {
            return [$config, []];
        }
        if (isset($config['class'])) {
            $type = $config['class'];
            unset($config['class']);

            return [$type, $config];
        }

        throw new CException(self::t('yii', 'Object configuration must be an array containing a "class" element.'));
    }
}
