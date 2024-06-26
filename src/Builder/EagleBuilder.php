<?php

namespace Rapid\Eagle\Builder;

use Rapid\Eagle\EagleContext;
use Rapid\Eagle\View\EView;

class EagleBuilder
{

    public function __construct(
        public readonly EagleContext $context,
    )
    {
    }

    protected function findView(string $name, array $parameters = [])
    {
        return new EView($this->context, $name, $parameters);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->findView($name, $arguments);
    }

    public function __get(string $name)
    {
        return new EaglePathBuilder($this->context, $name);
    }

}