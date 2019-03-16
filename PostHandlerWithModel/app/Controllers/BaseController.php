<?php

namespace App\Controllers;

use Interop\Container\ContainerInterface;

abstract class BaseController{

    protected $container;

    public function __construct(ContainerInterface $c){
        $this->container = $c;
    }
}