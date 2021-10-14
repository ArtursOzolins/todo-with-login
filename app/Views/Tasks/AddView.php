<?php require_once 'app/Views/Partials/TaskBeginning.php'; ?>

    <form action="/tasks" method="post">
        <label for="task">New task:</label>
        <input type="text" id="task" name="task" placeholder="enter to-do"><br><br>
        <input type="submit" value="Submit">
    </form>

<button type="button" onclick="location.href = '/tasks';">Back</button>

</body>
</html>