<?php

error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();
session_unset();

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
    <title>KingdomOfGrain</title>
</head>

<body>
<div>

    Сессии очищены!

    <form action="index.php" method="post">
        <input type="submit" name="submit"  value="Выйти в меню">
    </form>
</div>
</body>
</html>
