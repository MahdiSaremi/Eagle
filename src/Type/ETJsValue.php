<?php

namespace Rapid\Eagle\Type;

use Rapid\Eagle\EagleContext;
use Rapid\Eagle\EagleConverter;
use Rapid\Eagle\View\ERender;

class ETJsValue extends ERender implements EagleJsValuable
{

    public function __construct(
        EagleContext $context,
        protected $value,
    )
    {
        parent::__construct($context);
    }

    public function toHtml()
    {
        return $this->toJsValue();
    }

    public function toJsValue() : string
    {
        return EagleConverter::valueToJsValue($this->value);
    }

}