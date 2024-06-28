<?php

use Odan\Session\Middleware\SessionStartMiddleware;
use Slim\App;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Start the session
    $app->add(SessionStartMiddleware::class);

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Handle exceptions
    $app->addErrorMiddleware(true, true, true);
};