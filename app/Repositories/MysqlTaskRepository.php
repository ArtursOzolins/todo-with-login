<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Models\Collections\TaskCollection;
use PDO;
use PDOException;

class MysqlTaskRepository implements TaskRepository
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

    public function readFromFile(): TaskCollection
    {
        $sql = "SELECT user, title FROM tasks";
        $stmt = $this->connection->query($sql);
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $collection = [];
        foreach ($tasks as $task)
        {
            if ($task['user'] === $_SESSION['user'])
                array_push($collection, new Assignment($task['user'], $task['title']));
        }
        return new TaskCollection($collection);
    }

    public function addToFile(Assignment $task): void
    {
        $sql = "INSERT INTO tasks (user, title) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            $_SESSION['user'],
            $task->getTask()
        ]);
    }

    public function delete(Assignment $task): void
    {
        $sql = "DELETE FROM tasks WHERE title = ?";
        $stmt = $this->connection->prepare($sql);
        ($stmt->execute([$task->getTask()]));
    }

    public function taskEdit($oldTask, $newTask)
    {
        $data = [
            'user' => $_SESSION['user'],
            'oldtask' => $oldTask,
            'newtask' => $newTask
        ];
        $sql = "UPDATE tasks SET title=:newtask WHERE user=:user AND title=:oldtask";
        $stmt= $this->connection->prepare($sql);
        $stmt->execute($data);
    }
}
