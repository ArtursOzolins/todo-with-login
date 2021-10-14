<?php
require_once 'app/Views/Partials/UsersBeginning.php';
?>


<form action="/" method="post">
    Choose your name:<br>
    <label for="name"></label>
    <input type="text" id="name" name="name" placeholder="login"><br><br>
    Choose your password:<br>
    <label for="password"></label>
    <input type="text" id="password" name="password" placeholder="password"><br><br>
    <input type="submit" value="Submit">
</form><br>

</body>
</html>