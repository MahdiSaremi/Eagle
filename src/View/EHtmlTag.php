<?php

namespace Rapid\Eagle\View;

use Rapid\Eagle\Components\Style\ETStyle;
use Rapid\Eagle\EagleContext;
use Rapid\Eagle\EagleConverter;
use Rapid\Eagle\Type\ETMergeClass;

class EHtmlTag extends ERender
{

    protected array $parameters;

    public function __construct(
        EagleContext $context,
        protected string $tag = 'div',
        protected $slot = null,
        protected ?ETStyle $style = null,
        protected ?bool $close = null,
        protected ?bool $inline = null,
        ...$parameters,
    )
    {
        parent::__construct($context);
        $this->parameters = $parameters;
    }

    public function toHtml()
    {
        $params = $this->parameters;

        if (isset($this->style))
        {
            if (isset($params['class']))
            {
                $params['class'] = new ETMergeClass($this->context, $params['class'], $this->style->toClass());
            }
            else
            {
                $params['class'] = $this->style->toClass();
            }
        }

        $attributes = EagleConverter::attributesToHtml($params);

        if ($this->isInlineMode())
            return "<{$this->tag}{$attributes}/>";

        if ($this->isNotCloseMode())
            return "<{$this->tag}{$attributes}>";

        return "<{$this->tag}{$attributes}>" . EagleConverter::viewToHtml($this->slot) . "</{$this->tag}>";
    }

    protected function isInlineMode()
    {
        if ($this->inline !== null)
            return $this->inline;

        return false;
        // return in_array($this->tag, []);
    }

    protected function isNotCloseMode()
    {
        if ($this->close !== null)
            return !$this->close;

        return in_array($this->tag, ['input', 'meta']);
    }

}