<?php

$app = eagle()
    ->newComponent()
    ->property('click', $click)
    ->properties($props)
    ->build();

$app->render(
    $app->tag(
        'button',
        id: 'my-btn',
        slot: 'Click Here!',
        class: 'x',
    )->merge($props),
);
