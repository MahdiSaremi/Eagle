<?php

use Rapid\Eagle\Eagle;

if (!function_exists('eagle'))
{
    /**
     * Get eagle instance
     *
     * @return Eagle
     */
    function eagle() : Eagle
    {
        return app(Eagle::class);
    }
}
