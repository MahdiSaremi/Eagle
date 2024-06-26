<?php

namespace Rapid\Eagle\Type;

use Rapid\Eagle\EagleContext;
use Rapid\Eagle\EagleConverter;
use Rapid\Eagle\EObject;

class ETBindAttr extends EObject implements EagleJsHtmlable
{

    public function __construct(
        EagleContext $context,
        protected $js,
        protected $default = null,
    )
    {
        parent::__construct($context);
    }

    public function toJsHtml() : string
    {
        return EagleConverter::valueToJsHtml($this->js);
    }

    public function hasDefault()
    {
        return isset($this->default);
    }

    public function getDefault()
    {
        return $this->default;
    }
    
}