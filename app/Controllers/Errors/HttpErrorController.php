<?php

namespace App\Controllers\Errors;

use App\Core\Controller;

class HttpErrorController extends Controller
{
    public function errorNotFound(): void
    {
        http_response_code(404);
        $this->view('errors/notFound/index');
        return;
    }

    public function errorUnauthorized(): void
    {
        http_response_code(401);
        $this->view('errors/unauthorized/index');
        return;
    }

    public function errorInternalServerError(): void
    {
        http_response_code(500);
        $this->view('errors/internalServerError/index');
        return;
    }
}
