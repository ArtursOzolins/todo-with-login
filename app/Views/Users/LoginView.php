<?php
require_once 'app/Views/Partials/UsersBeginning.php';
?>


<form action="/login" method="post">
    Enter name:<br>
    <label for="name"></label>
    <input type="text" id="name" name="name" placeholder="login"><br><br>
    Enter password:<br>
    <label for="password"></label>
    <input type="text" id="password" name="password" placeholder="password"><br><br>
    <input type="submit" value="Submit">
</form><br>
<button type="button" onclick="location.href = '/';">Back</button>
</body>
</html>