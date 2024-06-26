<?php

$app = eagle()
    ->newComponent()
    ->build();

$app->render(
    $app->layouts->appLayout(
        slot: $app->buttons->primary(),
    ),
);
