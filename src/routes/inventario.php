<?php
namespace App\Routes;
use Slim\App;
use Slim\Psr7\Response;
use Slim\Psr7\Request;
use App\Models\Inventario;

return function (App $app) {
    // Obtener todo el inventario
    $app->get('/inventario', function (Request $request, Response $response) {
        $inventario = Inventario::all();
        return $response->withJson($inventario);
    });

    // Obtener inventario de un taller específico
    $app->get('/inventario/{idTaller}', function (Request $request, Response $response, $args) {
        $inventario = Inventario::where('idTaller', $args['idTaller'])->get();
        return $response->withJson($inventario);
    });

    // Agregar una pieza al inventario de un taller
    $app->post('/inventario', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $inventario = Inventario::create($data);
        return $response->withJson($inventario, 201);
    });

    // Modificar cantidad de una pieza en inventario
    $app->put('/inventario/{id}', function (Request $request, Response $response, $args) {
        $inventario = Inventario::find($args['id']);
        if (!$inventario) {
            return $response->withJson(['error' => 'Registro de inventario no encontrado'], 404);
        }
        $inventario->update($request->getParsedBody());
        return $response->withJson($inventario);
    });

    // Eliminar una pieza del inventario
    $app->delete('/inventario/{id}', function (Request $request, Response $response, $args) {
        $inventario = Inventario::find($args['id']);
        if (!$inventario) {
            return $response->withJson(['error' => 'Registro de inventario no encontrado'], 404);
        }
        $inventario->delete();
        return $response->withJson(['message' => 'Registro de inventario eliminado']);
    });
};