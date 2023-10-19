<?php

namespace Synsei\DiContainer;

use Psr/Container/ContainerInterface;

class DiContainer implements ContainerInterface
{
    private array $dependencies;

    public function __construct($configPath)
    {
        $this->dependencies = require $configPath;
    }

    public function get($class)
    {
        if (!$this->has($class)) {
            throw new NotFoundException("Need to add class to dependencies: " . $class);
        }

        $factory = $this->dependencies[$class];
        return $factory($this);
    }

    public function has($class): bool {
	return isset($this->dependencies[$class]);
    }
}
