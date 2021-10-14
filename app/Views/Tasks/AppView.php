<?php
require_once 'app/Views/Partials/TaskBeginning.php';
?>
<button type="button" onclick="location.href = '/';">Logout</button>
</br>
<h1>Your active assignments:</h1>
    <ul>
        <?php foreach ($tasks as $key => $task): ?>
            <li>
                <?php if ($_SESSION['name'] === $task->getUser()) {echo "{$task->getTask()}";} ?>
                <form method="post" action="/tasks/<?php echo $key; ?>">
                    <button type="submit">DELETE</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

<button type="button" onclick="location.href = '/tasks/add';">Add NEW</button>


</body>
</html>