<?php

namespace Rapid\Eagle;

use Rapid\Eagle\Components\Style\ETStyle;
use Rapid\Eagle\Components\Style\ETStyleGroup;

class EagleContext
{

    public function __construct(
        protected ?ETStyle $defaultStyle = null,
        protected ?ETStyleGroup $buttonStyle = null,
        protected ?ETStyle $bodyStyle = null,
    )
    {
        if (is_null($this->defaultStyle))
        {
            $this->defaultStyle = new ETStyle(/*$this*/);
        }
    }

    public function getDefaultStyle()
    {
        return $this->defaultStyle;
    }

    public function getButtonStyle(string $name = 'primary')
    {
        return $this->buttonStyle?->get($name) ?? $this->getDefaultStyle();
    }

    public function getBodyStyle()
    {
        return $this->bodyStyle ?? $this->getDefaultStyle();
    }

}