<?php
namespace App\Routes;
use Slim\App;

return function (App $app) {
    // Importar todas las rutas
    (require __DIR__ . '/auth.php')($app);
    (require __DIR__ . '/talleres.php')($app);
    (require __DIR__ . '/piezas.php')($app);
    (require __DIR__ . '/inventario.php')($app);
    (require __DIR__ . '/solicitudes.php')($app);
    (require __DIR__ . '/status.php')($app);
    (require __DIR__ . '/history.php')($app);
};