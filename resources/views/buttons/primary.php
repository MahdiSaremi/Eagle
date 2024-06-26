<?php

$app = eagle()
    ->newComponent()
    ->build();

$app->render(
    $app->button(
        slot: "Hi",
    )
);
