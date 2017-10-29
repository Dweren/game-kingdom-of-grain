<?php

error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();

include 'connection.php';

if(isset($_POST['login'], $_POST['password'])) {
    $res = q("
		SELECT *
		FROM `save`
		WHERE `login` = '".mysqli_real_escape_string($link, $_POST['login'])."'
		  AND `password` = '".mysqli_real_escape_string($link, $_POST['password'])."'
		LIMIT 1
	");
    if(mysqli_num_rows($res)) {
        $_SESSION['user'] = mysqli_fetch_assoc($res);
        $status = 'OK';
    } else {
        $error = '<h3>Нет пользователя с таким логином или паролем</h3>';
    }
}

?>




<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
    <title>KingdomOfGrain</title>
</head>

<body>
    <div>
        <?php if(!isset($status) || $status != 'OK') {echo @$error; ?>

        <p>Continue</p>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Логин:</td>
                    <td><input type="text" name="login"></td>
                </tr>
                <tr>
                    <td>Пароль:</td>
                    <td><input type="password" name="password"></td>
                </tr>
            </table>
            <input type="submit" name="game"  value="В игру">

        </form>

        <div>
            <form action="index.php" method="post">
                <input type="submit" name="restart"  value="Выйти в меню">
            </form>
        </div>

        <?php } else { ?>
            <div><h3>Поздравляю, Вы авторизированы</h3></div>

            <div>
                <form action="action.php" method="post">
                    <input type="submit" name="submit"  value="В игру">
                </form>
            </div>

        <?php } ?>

    </div>
</body>
</html>
