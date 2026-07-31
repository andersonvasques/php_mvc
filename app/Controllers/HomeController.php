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

    public function create(): void
    {
        $usuario = new Usuario();

        // Mudarei
        $data = $usuario->createUser([
            'nome_usuario'  => 'teste_usuario',
            'email_usuario' => 'teste123@gmail.com',
            'senha_usuario' => '1234'
        ]);

        $this->view('home/index', $data);
    }

    public function contact(): void
    {
        $this->view('home/contact');
    }
}
