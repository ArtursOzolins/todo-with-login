<?php

namespace App\Controllers;

use App\Models\Assignment;
use App\Models\Collections\TaskCollection;
use App\Models\User;
use App\Repositories\CSVTaskRepository;
use App\Repositories\MysqlTaskRepository;
use App\Repositories\TaskRepository;

class AssignmentController
{

    private TaskRepository $taskRepository;
    private array $tasks;

    public function __construct()
    {
        $this->taskRepository = new MysqlTaskRepository();
        $this->tasks = $this->taskRepository->readFromFile()->getTasks();
    }

    public function index()
    {
        require_once 'app/Views/Tasks/AppView.php';
    }

    public function add()
    {
        require_once 'app/Views/Tasks/AddView.php';
    }

    public function storeNew(): void
    {
            $this->taskRepository->addToFile(new Assignment($_SESSION['user'], $_POST['task']));

            header('Location: /tasks');
    }

    public function delete(string $key): void
    {
        $repository = ($this->taskRepository)->readFromFile();
        $collection = $repository->getTasks();
        $this->taskRepository->delete($collection[(int)$key]);

        header('Location: /tasks');
    }

    public function editTask(int $key)
    {
        require_once 'app/Views/Tasks/EditView.php';
    }

    public function storeEdited($key)
    {
        $oldTask = $this->tasks[(int)$key]->getTask();
        $this->taskRepository->taskEdit($oldTask, $_POST['task']);
        header('Location: /tasks');
    }
}
