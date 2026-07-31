<?php

namespace App\Models\Usuario;

use App\Core\Model;

class Usuario extends Model
{
    public function getUserData(): array
    {
        $user = $this->fetchUser();

        return [
            'nome_usuario'  => $user['nome_usuario'],
            'email_usuario' => $user['email_usuario'],
        ];
    }

    public function fetchUser(): array
    {
        $result = $this->db->fetch("SELECT * FROM usuario");

        return $result;
    }

    public function fetchAllUsers(): array
    {
        $result = $this->db->fetchAll("SELECT * FROM usuario");

        return $result;
    }

    public function createUser(array $params = []): bool | object
    {
        $result = $this->db->execute('
            INSERT INTO usuario (
                nome_usuario,
                email_usuario,
                senha_usuario
            ) VALUES (
                :nome_usuario,
                :email_usuario,
                :senha_usuario
            )
        ', $params);

        return $result;
    }
}
