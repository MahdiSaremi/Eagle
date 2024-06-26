<?php

namespace Rapid\Eagle\View;

use Illuminate\Support\Str;
use Rapid\Eagle\EagleContext;

class EView extends ERender
{

    public function __construct(
        EagleContext $context,
        protected string $view,
        protected array $parameters,
    )
    {
        parent::__construct($context);
    }

    public function toHtml()
    {
        eagle()->putStack($this->context, $this->parameters);

        ob_start();
        include __DIR__ . '/../../resources/views/' . Str::kebab(str_replace('.', '/', $this->view)) . '.php';
        return ob_get_clean();
        // return view($this->view)->render();
    }

}