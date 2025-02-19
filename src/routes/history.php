<?php
namespace App\Routes;
use Slim\App;
use Slim\Psr7\Response;
use Slim\Psr7\Request;
use App\Models\HistorySolicitud;

return function (App $app) {
    // Obtener todo el historial
    $app->get('/history', function (Request $request, Response $response) {
        $history = HistorySolicitud::all();
        return $response->withJson($history);
    });

    // Obtener historial de una solicitud específica
    $app->get('/history/{idSolicitud}', function (Request $request, Response $response, $args) {
        $history = HistorySolicitud::where('idSolicitud', $args['idSolicitud'])->get();
        return $response->withJson($history);
    });

    // Agregar un registro al historial
    $app->post('/history', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $history = HistorySolicitud::create($data);
        return $response->withJson($history, 201);
    });

    // Modificar un registro del historial
    $app->put('/history/{id}', function (Request $request, Response $response, $args) {
        $history = HistorySolicitud::find($args['id']);
        if (!$history) {
            return $response->withJson(['error' => 'Registro de historial no encontrado'], 404);
        }
        $history->update($request->getParsedBody());
        return $response->withJson($history);
    });

    // Eliminar un registro del historial
    $app->delete('/history/{id}', function (Request $request, Response $response, $args) {
        $history = HistorySolicitud::find($args['id']);
        if (!$history) {
            return $response->withJson(['error' => 'Registro de historial no encontrado'], 404);
        }
        $history->delete();
        return $response->withJson(['message' => 'Registro de historial eliminado']);
    });
};