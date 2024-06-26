<?php

namespace Rapid\Eagle\Type;

use Rapid\Eagle\EagleContext;
use Rapid\Eagle\EagleConverter;
use Rapid\Eagle\View\ERender;

class ETJs extends ERender implements EagleJsHtmlable
{

    public function __construct(
        EagleContext $context,
        protected $js,
    )
    {
        parent::__construct($context);
    }

    public function toHtml()
    {
        return $this->toJsHtml();
    }

    public function toJsHtml() : string
    {
        return EagleConverter::valueToJsHtml($this->js);
    }

}