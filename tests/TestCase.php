<?php

namespace Rapid\Eagle\Tests;

use Rapid\Eagle\EagleServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function getPackageProviders($app)
    {
        return [
            ...parent::getPackageProviders($app),
            EagleServiceProvider::class,
        ];
    }

}