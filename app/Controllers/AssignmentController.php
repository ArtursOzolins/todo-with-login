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

    public function __construct()
    {
        $this->taskRepository = new MysqlTaskRepository();
    }

    public function index()
    {
        $tasks = (($this->taskRepository->readFromFile()))->getTasks();
        /*
         * $taskList = [];
        foreach ($tasks as $task)
        {
            array_push($taskList, $task->getTask());
        }

        $loader = new \Twig\Loader\ArrayLoader(['task'=>'Do {{ name }}']);
        $twig = new \Twig\Environment($loader);
        foreach ($taskList as $task)
        {
            echo $twig->render('task', ['name' => $task]);
        }
         */

        require_once 'app/Views/Tasks/AppView.php';

        /*
         * <?php foreach ($tasks as $key => $task): ?>
            <li>
                <?php echo "{$task->getTask()}"; ?>
                    <form method="post" action="/<?php echo $key; ?>">
                        <button type="submit">DELETE</button>
                    </form>
            </li>
        <?php endforeach; ?>
         */
    }

    public function add()
    {
        require_once 'app/Views/Tasks/AddView.php';
    }

    public function store(): void
    {
        $this->taskRepository->addToFile(new Assignment($_SESSION['user'] ,$_POST['task']));

        header('Location: /tasks');
    }

    public function delete(string $key): void
    {
        $repository = ($this->taskRepository)->readFromFile();
        $collection = $repository->getTasks();
        $this->taskRepository->delete($collection[(int)$key]);

        header('Location: /tasks');
    }
}
