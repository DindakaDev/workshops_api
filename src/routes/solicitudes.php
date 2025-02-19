<?php
namespace App\Routes;
use Slim\App;
use Slim\Psr7\Response;
use Slim\Psr7\Request;
use App\Models\Solicitud;

return function (App $app) {
    // Obtener todas las solicitudes
    $app->get('/solicitudes', function (Request $request, Response $response) {
        $solicitudes = Solicitud::all();
        return $response->withJson($solicitudes);
    });

    // Obtener una solicitud específica
    $app->get('/solicitudes/{id}', function (Request $request, Response $response, $args) {
        $solicitud = Solicitud::find($args['id']);
        if (!$solicitud) {
            return $response->withJson(['error' => 'Solicitud no encontrada'], 404);
        }
        return $response->withJson($solicitud);
    });

    // Crear una nueva solicitud
    $app->post('/solicitudes', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $solicitud = Solicitud::create($data);
        return $response->withJson($solicitud, 201);
    });

    // Modificar una solicitud
    $app->put('/solicitudes/{id}', function (Request $request, Response $response, $args) {
        $solicitud = Solicitud::find($args['id']);
        if (!$solicitud) {
            return $response->withJson(['error' => 'Solicitud no encontrada'], 404);
        }
        $solicitud->update($request->getParsedBody());
        return $response->withJson($solicitud);
    });

    // Eliminar una solicitud
    $app->delete('/solicitudes/{id}', function (Request $request, Response $response, $args) {
        $solicitud = Solicitud::find($args['id']);
        if (!$solicitud) {
            return $response->withJson(['error' => 'Solicitud no encontrada'], 404);
        }
        $solicitud->delete();
        return $response->withJson(['message' => 'Solicitud eliminada']);
    });
};