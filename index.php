<?php

error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
    <title>KingdomOfGrain</title>
</head>

<body>
    <div>
        <div>
            <p>KingdomOfGrain</p>
        </div>

        <form action="registration.php" method="post">
            <p>
                <input type="submit" name="start" value="Новая игра"><br>
            </p>
        </form>
        <form action="continue.php" method="post">
            <p>
                <input type="submit" name="continue" value="Продолжить игру">
            </p>
        </form>
        <form action="action.php" method="post">
            <p>
                <input type="submit" name="continue" value="Action">
            </p>
        </form>
        <form action="manual.php" method="post">
            <p>
                <input type="submit" name="continue" value="Руководство">
            </p>
        </form>
        <form action="session_unset.php" method="post">
            <p>
                <input type="submit" name="unset" value="Очистка Сессии">
            </p>
        </form>
    </div>
</body>
</html>
