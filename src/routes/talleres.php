<?php
namespace App\Routes;
use Slim\App;
use Slim\Psr7\Response;
use Slim\Psr7\Request;
use App\Models\Taller;

return function (App $app) {
    // Obtener todos los talleres
    $app->get('/talleres', function (Request $request, Response $response) {
        $talleres = Taller::all();
        return $response->withJson($talleres);
    });

    // Obtener un taller por ID
    $app->get('/talleres/{id}', function (Request $request, Response $response, $args) {
        $taller = Taller::find($args['id']);
        if (!$taller) {
            return $response->withJson(['error' => 'Taller no encontrado'], 404);
        }
        return $response->withJson($taller);
    });

    // Crear un nuevo taller
    $app->post('/talleres', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $taller = Taller::create($data);
        return $response->withJson($taller, 201);
    });

    // Actualizar un taller
    $app->put('/talleres/{id}', function (Request $request, Response $response, $args) {
        $taller = Taller::find($args['id']);
        if (!$taller) {
            return $response->withJson(['error' => 'Taller no encontrado'], 404);
        }
        $taller->update($request->getParsedBody());
        return $response->withJson($taller);
    });

    // Eliminar un taller
    $app->delete('/talleres/{id}', function (Request $request, Response $response, $args) {
        $taller = Taller::find($args['id']);
        if (!$taller) {
            return $response->withJson(['error' => 'Taller no encontrado'], 404);
        }
        $taller->delete();
        return $response->withJson(['message' => 'Taller eliminado']);
    });
};