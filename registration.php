<?php

error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();

include 'connection.php';

if(isset($_POST['login'], $_POST['password'], $_POST['repeat'])) {
    $errors = array();
    if(empty($_POST['login'])) {
        $errors['login'] = 'Вы не заполнили логин';
    } elseif(mb_strlen($_POST['login']) < 2) {
        $errors['login'] = 'Логин слишком короткий';
    } elseif(mb_strlen($_POST['login']) > 16) {
        $errors['login'] = 'Логин слишком длинный';
    }

    if(mb_strlen($_POST['password']) < 5) {
        $errors['password'] = 'Пароль должен быть больше 4-х символов';
    }

    if($_POST['password'] !== $_POST['repeat']) {
        $errors['repeat'] = 'Вы неверно повторили пароль';

    }

    if(!count($errors)) {
        $res = q("
                    SELECT `id`
                    FROM `save`
                    WHERE `login` = '".$_POST['login']."'
                    LIMIT 1
                ");
        if(mysqli_num_rows($res)) {
            $errors['login'] = 'Такой логин уже занят';
        }
    }

    if(!count($errors)){
        q("
            INSERT INTO `save` SET
            `login` = '".mysqli_real_escape_string($link, $_POST['login'])."',
            `password` = '".mysqli_real_escape_string($link, $_POST['password'])."'
        ");

        $_SESSION['regok'] = 'OK';

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
        <?php if(!isset($_SESSION['regok'])){ ?>
        <p>Регистрация</p>

        <div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Логин:</td>
                        <td><input type="text" name="login" value="<?php echo @htmlspecialchars($_POST['login']); ?>"></td>
                        <td><?php echo @$errors['login']; ?></td>
                    </tr>

                    <tr>
                        <td>Пароль:</td>
                        <td><input type="password" name="password" value="<?php echo @htmlspecialchars($_POST['password']); ?>"></td>
                        <td><?php echo @$errors['password']; ?></td>
                    </tr>

                    <tr>
                        <td>Повторите пароль:</td>
                        <td><input type="password" name="repeat" value="<?php echo @htmlspecialchars($_POST['repeat']); ?>"></td>
                        <td><?php echo @$errors['repeat']; ?></td>
                    </tr>
                </table>
                <input type="submit" name="game" value="Зарегистрироваться">
            </form>
        </div>

        <div>
            <form action="index.php" method="post">
                <input type="submit" name="restart"  value="Выйти в меню">
            </form>
        </div>
        <?php } else {unset($_SESSION['regok']); ?>
            <div><h3>Вы успешно зарегистрировались</h3></div>

            <div>
                <form action="action.php" method="post">
                    <input type="submit" name="submit"  value="В игру">
                </form>
            </div>

        <?php } ?>
    </div>
</body>
</html>