<?php

namespace Rapid\Eagle;

use Rapid\Eagle\Type\ETMergeClass;

abstract class EObject
{

    public function __construct(
        public readonly EagleContext $context,
    )
    {
    }

    public function merge(...$parameters)
    {
        if (count($parameters) == 1 && array_key_first($parameters) == 0)
        {
            $parameters = $parameters[0];
        }

        foreach ($parameters as $key => $value)
        {
            $this->mergeItem($key, $value);
        }

        return $this;
    }

    public function mergeItem(string $name, $value)
    {
        if (property_exists($this, $name))
        {
            $this->$name = $this->mergeTwoItem($name, $this->$name, $value);
        }
        elseif (property_exists($this, 'parameters'))
        {
            $this->parameters[$name] = $this->mergeTwoItem($name, @$this->parameters[$name], $value);
        }

        return $this;
    }

    protected function mergeTwoItem(string $name, $old, $new)
    {
        switch ($name)
        {
            case 'class':
                if (!is_null($old))
                {
                    return new ETMergeClass($this->context, $old, $new);
                }
                break;
        }

        return $new;
    }

    /**
     * @param ...$parameters
     * @return static
     */
    public function copyWith(
        ...$parameters,
    )
    {
        return (clone $this)->merge(...$parameters);
    }

}