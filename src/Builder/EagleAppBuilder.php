<?php

namespace Rapid\Eagle\Builder;

use Rapid\Eagle\Components\EButton;
use Rapid\Eagle\Components\EHtmlDocument;
use Rapid\Eagle\Components\Style\ETStyle;
use Rapid\Eagle\EagleConverter;
use Rapid\Eagle\Type\ETBindAttr;
use Rapid\Eagle\Type\ETJs;
use Rapid\Eagle\Type\ETJsValue;
use Rapid\Eagle\View\EHtmlString;
use Rapid\Eagle\View\EHtmlTag;

class EagleAppBuilder extends EagleBuilder
{

    public function html(
        string $slot,
    )
    {
        return new EHtmlString($this->context, $slot);
    }

    public function tag(
        string $tag = 'div',
               $slot = null,
        ?ETStyle $style = null,
        bool $close = true,
        bool $inline = false,
               ...$parameters,
    )
    {
        return new EHtmlTag($this->context, ...func_get_args());
    }

    public function bind($js, $default = null)
    {
        return new ETBindAttr($this->context, $js, $default);
    }

    public function js($js)
    {
        return new ETJs($this->context, $js);
    }

    public function jsValue($value)
    {
        return new ETJsValue($this->context, $value);
    }

    public function render($view)
    {
        echo EagleConverter::viewToHtml($view);
    }

    public function htmlDocument(
        ?string $lang = null,
        ?string $title = null,
        bool $defaultMeta = true,
        $meta = null,
        $head = null,
        $body = null,
    )
    {
        return new EHtmlDocument($this->context, ...func_get_args());
    }

    public function style(
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
        return new ETStyle(/*$this->context, */...func_get_args());
    }

    public function button(
        $slot,
        $prefix = null,
        $suffix = null,
        string $styleName = 'primary',
        ?ETStyle $style = null,
        ?string $href = null,
    )
    {
        return new EButton($this->context, ...func_get_args());
    }

}