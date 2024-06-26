<?php

namespace Rapid\Eagle\View;

use Rapid\Eagle\EagleContext;

class EHtmlString extends ERender
{

    public function __construct(
        EagleContext $context,
        protected string $html,
    )
    {
        parent::__construct($context);
    }

    public function toHtml()
    {
        return $this->html;
    }

}