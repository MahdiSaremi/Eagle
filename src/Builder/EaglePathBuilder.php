<?php

namespace Rapid\Eagle\Builder;

use Rapid\Eagle\EagleContext;

class EaglePathBuilder extends EagleBuilder
{

    public function __construct(
        EagleContext $context,
        protected string $prefix,
    )
    {
        parent::__construct($context);
    }

    protected function findView(string $name, array $parameters = [])
    {
        return parent::findView($this->prefix . '.' . $name, $parameters);
    }

    public function __get(string $name)
    {
        return new EaglePathBuilder($this->context, $this->prefix . '.' . $name);
    }

}