<?php

namespace App\Models\Usuario;

class Usuario
{
    public function getUserData(): array
    {
        return [
            'name'  => 'Anderson',
            'age' => 20,
            'email' => 'teste@hotmail.com'
        ];
    }
}
