<?php
namespace App\Routes;
use Slim\App;
use Slim\Psr7\Response;
use Slim\Psr7\Request;
use App\Models\Status;

return function (App $app) {
    // Obtener todos los estatus
    $app->get('/status', function (Request $request, Response $response) {
        $status = Status::all();
        return $response->withJson($status);
    });

    // Obtener un estatus específico
    $app->get('/status/{id}', function (Request $request, Response $response, $args) {
        $status = Status::find($args['id']);
        if (!$status) {
            return $response->withJson(['error' => 'Estatus no encontrado'], 404);
        }
        return $response->withJson($status);
    });

    // Crear un nuevo estatus
    $app->post('/status', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $status = Status::create($data);
        return $response->withJson($status, 201);
    });

    // Modificar un estatus
    $app->put('/status/{id}', function (Request $request, Response $response, $args) {
        $status = Status::find($args['id']);
        if (!$status) {
            return $response->withJson(['error' => 'Estatus no encontrado'], 404);
        }
        $status->update($request->getParsedBody());
        return $response->withJson($status);
    });

    // Eliminar un estatus
    $app->delete('/status/{id}', function (Request $request, Response $response, $args) {
        $status = Status::find($args['id']);
        if (!$status) {
            return $response->withJson(['error' => 'Estatus no encontrado'], 404);
        }
        $status->delete();
        return $response->withJson(['message' => 'Estatus eliminado']);
    });
};