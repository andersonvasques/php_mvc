<?php

namespace App\Models\Usuario;

class Usuario
{
    public function getUserData(): array
    {
        return [
            'nome'  => 'Anderson',
            'idade' => 20,
            'email' => 'teste@email.com'
        ];
    }
}
