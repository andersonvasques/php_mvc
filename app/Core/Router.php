<?php

namespace App\Core;

use App\Controllers\Errors\HttpErrorController;

class Router extends Controller
{
    public function dispatch(string $url): void
    {
        // Removendo a / inicial e final
        $url            = trim($url, '/');

        /*
            Se existir uma url, então vai pegar essa url e se existir
            uma / então vai separar essa string e transformar em um array
            onde vai ter: [0] => "noticias" e [1] => "testando".
        */
        $parts          = $url ? explode('/', $url) : [];

        /*
            Se existir uma url, pega a primeira posição, ex.: noticias
            Se não existir então vai ser a Home.
        */
        $controllerName = $parts[0] ?? 'Home';

        /*
            Transforma a primeira letra da variável $controllerName
            em maiúscula e adiciona o Controller no final, ficando:
            NoticiasController ou HomeController se não existir uma url.
        */
        $controllerName = ucfirst($controllerName) . 'Controller';

        // Namespace completo do controller
        $controllerClass = "App\\Controllers\\{$controllerName}";

        if (!class_exists($controllerClass)) {
            $errorController = new HttpErrorController();
            $errorController->errorNotFound();
            return;
        }

        $controller = new $controllerClass();
        $actionName = $parts[1] ?? 'index';

        if (!method_exists($controller, $actionName)) {
            $errorController = new HttpErrorController();
            $errorController->errorNotFound();
            return;
        }

        $params = array_slice($parts, 2);

        call_user_func_array([$controller, $actionName], $params);
    }
}
