<?php

$app = eagle()
    ->newComponent()
    ->property('name', $name, 'string', true)
    ->build();

$app->render(
    "Hello $name!"
);
