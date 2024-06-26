<?php

namespace Rapid\Eagle\Builder;

use Rapid\Eagle\EagleContext;
use Rapid\Eagle\EagleType;

class EagleComponentMaker extends EagleMaker
{

    public function __construct(
        EagleContext $context,
        protected array $parameters,
    )
    {
        parent::__construct($context);
    }

    /**
     * Define a property
     *
     * @template T
     *
     * @param string                $name
     * @param T|mixed               $reference
     * @param class-string<T>|array $type
     * @param bool                  $required
     * @param                       $default
     * @return $this
     */
    public function property(
        string       $name,
                     &$reference,
        string|array $type = 'mixed',
        bool         $required = false,
                     $default = null,
    )
    {
        if (array_key_exists($name, $this->parameters))
        {
            $reference = $this->parameters[$name];
            unset($this->parameters[$name]);
        }
        elseif (is_int($key = @array_key_first($this->parameters)))
        {
            $reference = $this->parameters[$key];
            unset($this->parameters[$key]);
        }
        elseif ($required)
        {
            throw new \ArgumentCountError("Parameter [$name] is required");
        }
        else
        {
            $reference = value($default);
            return $this;
        }

        if (!EagleType::is($reference, $type))
        {
            throw new \TypeError("Parameter [$name] should be type of " . EagleType::getReadableType($type));
        }

        return $this;
    }

    public function properties(
        ?array &$reference,
        string|array $type = 'mixed',
    )
    {
        $reference = $this->parameters;
        $this->parameters = [];

        if (!EagleType::is($reference, [$type]))
        {
            throw new \TypeError("Parameters should be type of " . EagleType::getReadableType($type));
        }

        return $this;
    }

    /**
     * Build component
     *
     * @return EagleComponent
     */
    public function build()
    {
        if ($this->parameters)
        {
            throw new \InvalidArgumentException("Many parameters passed, unknown parameter [".array_key_first($this->parameters)."]");
        }

        return new EagleComponent($this->context);
    }

}