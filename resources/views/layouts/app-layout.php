<?php

$app = eagle()
    ->newComponent()
    ->property('title', $title)
    ->property('fullTitle', $fullTitle)
    ->property('slot', $slot)
    ->build();

$app->render(
    $app->htmlDocument(
        title: $fullTitle ?? $title . " | Eagle",
        body: $slot,
    )
);
