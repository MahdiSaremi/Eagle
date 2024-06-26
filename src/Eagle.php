<?php

namespace Rapid\Eagle;

use Rapid\Eagle\Builder\EagleComponentMaker;

class Eagle
{

    protected array $eagleStack = [];

    public function putStack(EagleContext $context, array $parameters)
    {
        $this->eagleStack[] = [$context, $parameters];
    }

    public function popStack()
    {
        return $this->eagleStack ? array_pop($this->eagleStack) : [];
    }

    public function newComponent()
    {
        [$context, $parameters] = $this->popStack();

        return new EagleComponentMaker($context, $parameters);
    }

}