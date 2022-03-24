<?php
declare(strict_types=1);

namespace App\Core;
use DI\Container;

abstract class Controller{

    private Container $container;
    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
    $this->container = $container;
    }

    /**
     * @param $property
     * @return void
     */
    public function __get($property)
    {   
        if($this->container->get($property)){
            return $this->container->get($property);
        }
    }

}