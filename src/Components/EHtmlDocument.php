<?php

namespace Rapid\Eagle\Components;

use Illuminate\Support\Facades\Lang;
use Rapid\Eagle\Builder\EagleAppBuilder;
use Rapid\Eagle\EagleContext;
use Rapid\Eagle\View\EComponent;

class EHtmlDocument extends EComponent
{

    public function __construct(
        EagleContext $context,
        protected ?string $lang = null,
        protected ?string $title = null,
        protected bool $defaultMeta = true,
        protected $meta = null,
        protected $head = null,
        protected $body = null,
    )
    {
        parent::__construct($context);
    }

    public function render()
    {
        $app = new EagleAppBuilder($this->context);

        return [
            $app->html('<!doctype html>'),
            $app->tag(
                'html',
                lang: $this->lang ?? Lang::getLocale(),
                slot: [
                    $app->tag(
                        'head',
                        slot: [
                            $this->defaultMeta ? [
                                $app->tag('meta', charset: 'UTF-8'),
                                $app->tag('meta', name: 'viewport', content: 'width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'),
                                $app->tag('meta', httpEquiv: 'X-UA-Compatible', content:'ie=edge'),
                            ] : null,
                            $this->meta,
                            $app->tag('title', slot: $this->title ?? env('APP_NAME')),
                            $this->head,
                        ],
                    ),
                    $app->tag(
                        'body',
                        slot: $this->body,
                        style: $this->context->getBodyStyle(),
                    ),
                ],
            ),
        ];
    }

}