<?php
require_once 'app/Views/Partials/TaskBeginning.php';
?>
<button type="button" onclick="location.href = '/';">Logout</button>
</br>
<h1>Assignment edit:</h1>
<ul>
        <li>
            <form action="/tasks/<?php echo $key; ?>" method="post">
                <label for="task">Edit task:</label>
                <input type="text" id="task" name="task" placeholder="<?php echo "{$this->tasks[$key]->getTask()}"; ?>"><br><br>
                <input type="submit" value="Submit">
            </form>
        </li>
</ul>

<button type="button" onclick="location.href = '/tasks';">Back</button>


</body>
</html>