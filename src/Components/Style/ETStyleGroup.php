<?php

namespace Rapid\Eagle\Components\Style;

class ETStyleGroup
{

    protected array $styles;

    public function __construct(
        ?ETStyle $default = null,
        ?ETStyle $primary = null,
        ?ETStyle $secondary = null,
        ?ETStyle $warning = null,
        ?ETStyle $danger = null,
        ?ETStyle $success = null,
        ?ETStyle $info = null,
        ETStyle ...$others,
    )
    {
        $this->styles = compact('default', 'primary', 'secondary', 'warning', 'danger', 'success', 'info') + $others;
    }

    /**
     * Get default style
     *
     * @return ?ETStyle
     */
    public function getDefault()
    {
        return $this->styles['default'] ?? null;
    }

    /**
     * Get style by name
     *
     * @param string $name
     * @return ?ETStyle
     */
    public function get(string $name)
    {
        return $this->styles[$name] ?? $this->getDefault();
    }

}