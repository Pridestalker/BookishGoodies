<?php

namespace Elderbraum\BookishGoodies\Bootstrap;

use DI\Container as IoContainer;

class Container
{
    /**
     * @var null|Container
     */
    protected static $_instance = null;

    /**
     * @var null|IoContainer
     */
    protected static $_container = null;

    public function __construct()
    {
        $this->buildContainer();
    }

    private function buildContainer()
    {
        if (static::$_container === null) {
            static::$_container = new IoContainer();
        }
    }

    /**
     * @param string $class
     *
     * @return mixed
     * @throws DependencyException
     * @throws NotFoundException
     */
    public static function get($class)
    {
        static::bootstrap();

        return static::$_container->get($class);
    }

    public static function bootstrap(): self
    {
        if (static::$_instance === null) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }
}
