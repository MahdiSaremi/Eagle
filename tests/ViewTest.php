<?php

namespace Rapid\Eagle\Tests;

use Rapid\Eagle\Components\Style\ETStyle;
use Rapid\Eagle\Components\Style\ETStyleGroup;
use Rapid\Eagle\EagleContext;
use Rapid\Eagle\View\EAppView;
use Rapid\Eagle\View\EView;

class ViewTest extends TestCase
{

    public function test_a()
    {
        // $view = new EAppView('home', []);
        $view = new EView(
            new EagleContext(
                bodyStyle: new ETStyle(
                    margin: 'm-0',
                ),
                buttonStyle: new ETStyleGroup(
                    primary: new ETStyle(
                        rounded: 'rounded-lg',
                    ),
                ),
            ),
            'home',
            []
        );

        echo $view->toHtml();
    }

}