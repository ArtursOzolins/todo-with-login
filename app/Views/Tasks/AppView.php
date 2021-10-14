<?php
require_once 'app/Views/Partials/TaskBeginning.php';
?>
<button type="button" onclick="location.href = '/';">Logout</button>
</br>
<h1>Your active assignments:</h1>
    <ul>
        <?php foreach ($this->tasks as $key => $task): ?>
            <li>
                <?php echo "{$task->getTask()}"; ?>
                <form method="post" action="/tasks/delete/<?php echo $key; ?>">
                    <button type="submit">DELETE</button>
                </form>
                <form method="post" action="/tasks/edit/<?php echo $key; ?>">
                    <button type="submit">EDIT</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

<button type="button" onclick="location.href = '/tasks/add';">Add NEW</button>


</body>
</html>