<?php

namespace App\Repositories;

use App\Models\Collections\UsersCollection;
use App\Models\User;
use PDO;
use PDOException;

class MysqlUserRepository implements UserRepository
{
    private PDO $connection;

    public function __construct()
    {
        $host = '127.0.0.1';
        $db   = 'todo-app';
        $user = 'root';
        $pass = '123456';


        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try {
            $this->connection = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function registrate(User $user): void
    {
        $sql = "INSERT INTO users (name, password) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            $user->getName(),
            $user->getPassword()
        ]);
    }

    public function getOne(string $name): ?User
    {
        $sql = "SELECT * FROM users WHERE name = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$name]);
        $user = $statement->fetch();
        if ($user['name'] === null) {
            return null;
        } else {
            return new User(
                $user['name'],
                $user['password']
            );
        }
    }

    public function readFromFile(): UsersCollection
    {
        $sql = "SELECT * FROM users";
        $statement = $this->connection->query($sql);
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        $collection = [];
        foreach ($users as $user)
        {
            array_push($collection, new User($user['name'], $user['password']));
        }
        return new UsersCollection($collection);
    }

    public function delete(User $user): void
    {
        // TODO: Implement delete() method.
    }
}

