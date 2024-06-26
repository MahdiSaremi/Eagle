<?php

namespace Rapid\Eagle\Components;

use Rapid\Eagle\Components\Style\ETStyle;
use Rapid\Eagle\EagleContext;
use Rapid\Eagle\View\EComponent;
use Rapid\Eagle\View\EHtmlTag;

class EButton extends EComponent
{

    public function __construct(
        EagleContext $context,
        protected $slot,
        protected $prefix = null,
        protected $suffix = null,
        protected string $styleName = 'primary',
        protected ?ETStyle $style = null,
        protected ?string $href = null,
    )
    {
        parent::__construct($context);
    }

    public function getStyle()
    {
        return $this->style ?? $this->context->getButtonStyle($this->styleName);
    }

    public function render()
    {
        if (isset($this->href))
        {
            return new EHtmlTag(
                $this->context,
                tag: 'a',
                slot: $this->slot,
                style: $this->getStyle(),
                href: $this->href,
            );
        }
        else
        {
            return new EHtmlTag(
                $this->context,
                tag: 'button',
                slot: $this->slot,
                style: $this->getStyle(),
            );
        }
    }

}