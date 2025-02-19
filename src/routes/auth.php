<?php

namespace App\Routes;
use Slim\App;
use Slim\Psr7\Response;
use Slim\Psr7\Request;
use App\Models\Usuario;

return function (App $app) {
    // Registrar usuario
    $app->post('/auth/register', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $usuario = Usuario::create($data);
        return $response->withJson($usuario, 201);
    });

    // Iniciar sesión
    $app->post('/auth/login', function (Request $request, Response $response) {
        print("llego a model");
        $data = $request->getParsedBody();
        $usuario = Usuario::where('username', $data['username'])->first();

        if ($usuario && password_verify($data['password'], $usuario->password)) {
            return $response->withJson(['message' => 'Login exitoso', 'usuario' => $usuario]);
        }
        return $response->withJson(['error' => 'Credenciales inválidas'], 401);
    });

    // Obtener datos del usuario autenticado
    $app->get('/auth/me', function (Request $request, Response $response) {
        $usuario = $request->getAttribute('usuario');
        return $response->withJson($usuario);
    });

    // Cerrar sesión
    $app->post('/auth/logout', function (Request $request, Response $response) {
        return $response->withJson(['message' => 'Sesión cerrada']);
    });
};