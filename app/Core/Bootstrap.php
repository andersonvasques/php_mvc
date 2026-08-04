<?php

namespace App\Core;

use App\Core\Router;
use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;

class Bootstrap
{
    public function run(): void
    {
        // createFromGlobals() vai conter $_GET, $_POST, $_COOKIE, $_FILES e $_SERVER
        $request = Request::createFromGlobals();

        $this->enviromentConfigure();
        $this->configure();
        $this->callRouter($request);
    }

    private function configure(): void
    {
        $this->iniConfigure();
        $this->timeZoneConfigure();
    }

    private function iniConfigure(): void
    {
        // Configurações do PHP
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
    }

    private function timeZoneConfigure(): void
    {
        // Configura o fuso horário
        date_default_timezone_set('America/Sao_Paulo');
    }

    private function callRouter(Request $request): void
    {
        $router = new Router();
        $router->dispatch($request);
    }

    private function enviromentConfigure(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
    }
}
