<?php

namespace App\Core;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private ?PDO $connection           = null;
    private static ?Database $instance = null;

    private function __construct()
    {
        $this->connect();
    }

    /*
        Singleton Design Pattern:
        Garante que apenas uma instância da classe Database seja criada.
    */
    public static function getInstance(): Database
    {
        /*
            Verifica se a instância já foi criada.
            Se não, cria uma nova instância da classe Database
            e a armazena na propriedade estática $instance.
            Se já existe apenas retorna a instância existente.
        */
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function connect(): void
    {
        $dbConfig = config('database');

        $dsn      = "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}";

        $options  = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->connection = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], $options);
            return;
        } catch (PDOException $e) {
            throw new Exception('Connection failed: ' . $e->getMessage());
        }
    }

    // Retorna um único resultado da consulta.
    public function fetch(string $sql, array $params = []): array | false
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    // Retorna um array com os dados da consulta.
    public function fetchAll(string $sql, array $params = []): array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    // Executa uma ação SQL.
    public function execute(string $sql, array $params = []): bool | object
    {
        $stmt = $this->query($sql, $params);

        if ($stmt->rowCount() == 0) {
            throw new Exception('No rows affected by the query.');
        } else {
            return $stmt->fetch();
        }
    }

    public function query(string $sql, array $params = []): bool | PDOStatement
    {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);

            return $stmt;
        } catch (PDOException $e) {
            throw new Exception('Query failed: ' . $e->getMessage());
        }
    }
}
