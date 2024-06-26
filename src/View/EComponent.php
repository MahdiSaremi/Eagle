<?php

namespace Rapid\Eagle\View;

use Rapid\Eagle\EagleConverter;

abstract class EComponent extends ERender
{

    public abstract function render();

    public function toHtml()
    {
        return EagleConverter::viewToHtml($this->render());
    }

}