<?php

namespace Rapid\Eagle\Components\Style;

use Rapid\Eagle\EagleContext;
use Rapid\Eagle\EObject;

class ETStyle extends EObject
{

    public array $parameters;

    public function __construct(
        // EagleContext $context,
        $padding = null,
        $margin = null,
        $width = null,
        $height = null,
        $size = null,
        $font = null,
        $fontSize = null,
        $border = null,
        $rounded = null,
        $color = null,
        $bgColor = null,
        $display = null,
        $align = null,
        $textAlign = null,
        ...$parameters
    )
    {
        $this->parameters = $parameters + compact(
                'padding',
                'margin',
                'width',
                'height',
                'size',
                'font',
                'fontSize',
                'border',
                'rounded',
                'color',
                'bgColor',
                'display',
                'align',
                'textAlign',
            );

        // parent::__construct($context);
    }

    public function toClass()
    {
        return collect($this->parameters)
            ->whereNotNull()
            ->implode(' ');
    }

}