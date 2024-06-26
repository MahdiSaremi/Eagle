<?php

namespace Rapid\Eagle\Builder;

use Rapid\Eagle\EagleContext;

abstract class EagleMaker
{

    public function __construct(
        public readonly EagleContext $context,
    )
    {
    }

    public function build()
    {

    }

}