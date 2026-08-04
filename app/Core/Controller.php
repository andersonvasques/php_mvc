<?php

namespace App\Core;

use App\Controllers\Errors\HttpErrorController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class Controller
{
    protected Request $request;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    protected function view(string $view, array | object $viewData = []): void
    {
        extract($viewData);

        $viewFile = __DIR__ .  '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            $errorController = new HttpErrorController();
            $errorController->errorNotFound();
            return;
        }

        require_once $viewFile;
    }

    protected function json(array $data, int $statusCode = 200): never
    {
        $response = new JsonResponse($data, $statusCode);
        $response->send();
        exit;
    }

    protected function redirect(string $url, int $statusCode = 302): never
    {
        $response = new RedirectResponse($url, $statusCode);
        $response->send();
        exit;
    }
}
