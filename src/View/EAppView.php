<?php

namespace Rapid\Eagle\View;

use Rapid\Eagle\Builder\EagleAppBuilder;
use Rapid\Eagle\EagleContext;

class EAppView extends EView
{

    public function __construct(
        string $view,
        array $parameters
    )
    {
        parent::__construct(new EagleContext(), $view, $parameters);
    }

}