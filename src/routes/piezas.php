<?php
namespace App\Routes;
use Slim\App;
use Slim\Psr7\Response;
use Slim\Psr7\Request;
use App\Models\Pieza;

return function (App $app) {
    // Obtener todas las piezas
    $app->get('/piezas', function (Request $request, Response $response) {
        $piezas = Pieza::all();
        return $response->withJson($piezas);
    });

    // Obtener una pieza por ID
    $app->get('/piezas/{id}', function (Request $request, Response $response, $args) {
        $pieza = Pieza::find($args['id']);
        if (!$pieza) {
            return $response->withJson(['error' => 'Pieza no encontrada'], 404);
        }
        return $response->withJson($pieza);
    });

    // Crear una nueva pieza
    $app->post('/piezas', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $pieza = Pieza::create($data);
        return $response->withJson($pieza, 201);
    });

    // Actualizar una pieza
    $app->put('/piezas/{id}', function (Request $request, Response $response, $args) {
        $pieza = Pieza::find($args['id']);
        if (!$pieza) {
            return $response->withJson(['error' => 'Pieza no encontrada'], 404);
        }
        $pieza->update($request->getParsedBody());
        return $response->withJson($pieza);
    });

    // Eliminar una pieza
    $app->delete('/piezas/{id}', function (Request $request, Response $response, $args) {
        $pieza = Pieza::find($args['id']);
        if (!$pieza) {
            return $response->withJson(['error' => 'Pieza no encontrada'], 404);
        }
        $pieza->delete();
        return $response->withJson(['message' => 'Pieza eliminada']);
    });
};