<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario\Usuario;

class HomeController extends Controller
{
    public function index(): void
    {
        $usuario = new Usuario();
        $data    = $usuario->getUserData();

        $this->view('home/index', $data);
    }

    public function contact(): void
    {
        $this->view('home/contact');
    }
}
