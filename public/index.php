<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$app->setBasePath($basePath);

require __DIR__ . '/../config/database.php';
(require __DIR__ . '/../src/routes/index.php')($app);

$app->run();