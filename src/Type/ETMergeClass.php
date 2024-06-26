<?php

namespace Rapid\Eagle\Type;

use Rapid\Eagle\EagleContext;
use Rapid\Eagle\EagleConverter;
use Rapid\Eagle\View\ERender;

class ETMergeClass extends ERender
{

    public function __construct(
        EagleContext $context,
        protected $left,
        protected $right,
    )
    {
        parent::__construct($context);
    }

    public function toHtml()
    {
        return EagleConverter::viewToHtml($this->left) . ' ' . EagleConverter::viewToHtml($this->right);
    }

}