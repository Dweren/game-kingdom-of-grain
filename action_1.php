<?php

error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
session_start();

$rats = 0;

$tmp_n = '';
$tmp_nn = '';

$tmp_f = '';
$tmp_fn = '';

$tmp_l = '';
$tmp_ln = '';

$tmp_w = '';
$tmp_wn = '';

//$message = 'SESSION<pre>'.print_r($_SESSION, 1).'</pre>';

$notice = '';
$end_game = '';

//TODO: Описать событие лазутчик
//TODO: Описать событие пожар
//TODO: Разобраться с кастылями при потребности населения ниже нормы
//TODO: Оптимизировать интерфейс и сделать его более понятным

if(isset($_POST['step'])) {
    $_SESSION['year'] = $_SESSION['year'] + 1;
    $_SESSION['land_price'] = rand(20, 50);

    //вычисление остатка зерна после операций прошлого хода
    $_SESSION['grain'] = $_SESSION['grain'] - $_SESSION['grain_calc'];

    $_SESSION['grain'] = $_SESSION['grain'] + ($_SESSION['farmer'] * $_SESSION['farmer_harvest'] * $_SESSION['harvest']);

    //Дворцовый переворот
    if(rand(1, 100) == 13) {
        $end_game = '<p>Дворцовый переворот! Вас свергли.</p><br>
            <img src="img/mogila.jpg"><br>';
    }

    //Когда потребности населения меньше нормы
    if($_SESSION['needs'] < 22) {
        if($_SESSION['needs'] >= 10){
            if(($_SESSION['needs'] == 10) && (rand(1, 100) >= 10)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 11) && (rand(1, 100) >= 20)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 12) && (rand(1, 100) >= 30)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 13) && (rand(1, 100) >= 40)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 14) && (rand(1, 100) >= 50)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 15) && (rand(1, 100) >= 60)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 16) && (rand(1, 100) >= 70)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 17) && (rand(1, 100) >= 80)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 18) && (rand(1, 100) >= 90)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 19) && (rand(1, 100) >= 93)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 20) && (rand(1, 100) >= 96)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
            if(($_SESSION['needs'] == 21) && (rand(1, 100) >= 99)){
                $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
                <img src="img/mogila.jpg"><br>';
            }
        }else{
            $end_game = '<p>Люди не хотят правителя, который заставляет их голодать.</p><br>
            <img src="img/mogila.jpg"><br>';
        }
    }

    //Урожай или неурожай или ничего
    if(($_SESSION['farmer'] > 0) && (rand(1, 2) == 2)){
        $chance_harvest = rand(1, 5);
        if($chance_harvest == 1){
            $_SESSION['grain'] = $_SESSION['grain'] + (($_SESSION['farmer'] * $_SESSION['farmer_harvest'] * $_SESSION['harvest']) / 5);
            $notice .= '<p>Урожайный год.</p><br>
            <img src="img/urojay.jpg"><br>';
        }elseif($chance_harvest == 2){
            $_SESSION['grain'] = $_SESSION['grain'] - (($_SESSION['farmer'] * $_SESSION['farmer_harvest'] * $_SESSION['harvest']) / 10);
            $notice .= '<p>Не урожайный год. Потеряно 1/10 урожая.</p><br>
            <img src="img/urojay.jpg"><br>';
        }elseif($chance_harvest == 3){
            $_SESSION['grain'] = $_SESSION['grain'] - (($_SESSION['farmer'] * $_SESSION['farmer_harvest'] * $_SESSION['harvest']) / 9);
            $notice .= '<p>Не урожайный год. Потеряно 1/9 урожая.</p><br>
            <img src="img/urojay.jpg"><br>';
        }elseif($chance_harvest == 4){
            $_SESSION['grain'] = $_SESSION['grain'] - (($_SESSION['farmer'] * $_SESSION['farmer_harvest'] * $_SESSION['harvest']) / 8);
            $notice .= '<p>Не урожайный год. Потеряно 1/8 урожая.</p><br>
            <img src="img/urojay.jpg"><br>';
        }else{
            $_SESSION['grain'] = $_SESSION['grain'] - (($_SESSION['farmer'] * $_SESSION['farmer_harvest'] * $_SESSION['harvest']) / 7);
            $notice .= '<p>Нашествие саранчи. Потеряно 1/7 урожая.</p><br>
            <img src="img/urojay.jpg"><br>';
        }
    }

    //Чума
    if(rand(1, 7) == 1) {
        $chuma = rand(($_SESSION['people'] + $_SESSION['warriors'] + $_SESSION['farmer'])/4, ($_SESSION['people'] + $_SESSION['warriors'] + $_SESSION['farmer'])/2);
        $_SESSION['people'] = $_SESSION['people'] - $chuma;
        $notice .= '<p>Чума. Унесла '.$chuma.' жизней.</p><br>
            <img src="img/chuma.jpg"><br>';
    }

    //Нападение
    if($_SESSION['enemy'] == 0) {
        if(rand(1, 2) == 1) {
            $_SESSION['distance'] = rand(30, 70);
            $_SESSION['enemy'] = rand(($_SESSION['people'] + $_SESSION['warriors'] + $_SESSION['farmer'])/3, ($_SESSION['people'] + $_SESSION['warriors'] + $_SESSION['farmer'])/2);
            $notice .= '<p>На Вас напали! Силы врага - '.
                $_SESSION['enemy'].' чел. Расстояние - '.$_SESSION['distance'].'</p>'.
                '<br><img src="img/war.jpg"><br>';
        }
    }

    //Расстояние до нападающих и битва
    if(isset($_SESSION['distance'])) {
        if($_SESSION['distance'] > 0) {
            $_SESSION['distance'] = $_SESSION['distance'] - rand(8, 16);
        }

        if($_SESSION['distance'] <= 0) {
            if($_SESSION['warriors'] < $_SESSION['enemy']){
                $end_game = '<p>Ваша армия разбита. Вы проиграли!</p>
                <br><img src="img/battle.jpg"><br>';
            } else {
                unset($_SESSION['distance']);
                $_SESSION['warriors'] = $_SESSION['warriors'] - $_SESSION['enemy'];
                $_SESSION['enemy'] = 0;
                $notice .= '<p>Битва! Ваша армия победила. Выжило '.$_SESSION['warriors'].'</p>
                <br><img src="img/battle_1.jpg"><br>';
            }
        }
    }

    //Сожрали крысы
    if(rand(1, 3) == 1) {
        $rats = rand($_SESSION['grain']/20, $_SESSION['grain']/5);
        $_SESSION['grain'] = $_SESSION['grain'] - $rats;
        $notice .= '<p>Крысы сожрали '.$rats.' бушелей зерна.</p><br>
            <img src="img/chuma.jpg"><br>';
    }

    $_SESSION['people'] = $_SESSION['people'] + $_SESSION['born'] + $_SESSION['refugees'] - $_SESSION['die'];
    $_SESSION['refugees'] = rand(0, 10);
    $_SESSION['born'] = rand(0, 5);
    $_SESSION['die'] = rand(0, 5);
    $_SESSION['harvest'] = rand(2, 5);

}elseif(!isset($_POST['calc'])) {

    //Стартовое генерирование значений
    $_SESSION['year'] = 1;
    $_SESSION['harvest'] = rand(2, 5);
    $_SESSION['farmer'] = 0;
    $_SESSION['farmer_harvest'] = rand(9, 11);
    $_SESSION['land_price'] = rand(20, 50);
    $_SESSION['grain'] = rand(3000, 4000);
    $_SESSION['land'] = rand(500, 1000);
    $_SESSION['people'] = rand(90, 120);
    $_SESSION['refugees'] = rand(0, 10);
    $_SESSION['born'] = rand(0, 5);
    $_SESSION['die'] = rand(0, 5);
    $_SESSION['warriors'] = 0;
    $_SESSION['enemy'] = 0;
    $_SESSION['needs'] = 0;
    $_SESSION['grain_calc'] = 0;
}

//Действия когда заканчивается зерно
if($_SESSION['grain'] < 0){
    $end_game = '<p>Когда закончилось зерно, закончилась и Ваша жизнь.</p><br>
            <img src="img/mogila.jpg"><br>';
}

//Вычисление изменений
if(isset($_POST['calc'])) {

    //Количество зерна на одного крестьянина
    if(isset($_POST['n_val'], $_POST['n_action'])){
        if($_POST['n_action'] == '+'){
            if((($_SESSION['needs'] + $_POST['n_val'])*($_SESSION['people']+$_SESSION['farmer'])) > $_SESSION['grain']){
                $tmp_n = ($_SESSION['grain']/($_SESSION['people']+$_SESSION['farmer']));
                $tmp_nn = '<br>Максимум можно увеличить:';
            } else {
                $_SESSION['needs'] = $_SESSION['needs'] + $_POST['n_val'];
            }

        } elseif ($_POST['n_action'] == '-') {
            if($_POST['n_val'] > $_SESSION['needs']){
                $tmp_n = $_SESSION['needs'];
                $tmp_nn = '<br>Максимум можно уменьшить:';
            } else {
                $_SESSION['needs'] = $_SESSION['needs'] - $_POST['n_val'];
            }
        }
    }

    //управление количеством хлеборобов
    if(isset($_POST['f_val'], $_POST['f_action'])) {
        if($_POST['f_action'] == '+') {
            if(($_POST['f_val'] > $_SESSION['people']) || (($_SESSION['land'] / $_SESSION['farmer_harvest']) < ($_SESSION['farmer'] + $_POST['f_val']))) {
                $tmp_f = ($_SESSION['land'] / $_SESSION['farmer_harvest']) - $_SESSION['farmer'];
                $tmp_fn = '<br>Максимум можно увеличить:';
            } else {
                $_SESSION['farmer'] = $_SESSION['farmer'] + $_POST['f_val'];
                $_SESSION['people'] = $_SESSION['people'] - $_POST['f_val'];
            }

        } elseif ($_POST['f_action'] == '-') {
            if($_POST['f_val'] > $_SESSION['farmer']) {
                $tmp_f = $_SESSION['farmer'];
                $tmp_fn = '<br>Максимум можно уменьшить:';
            } else {
                $_SESSION['farmer'] = $_SESSION['farmer'] - $_POST['f_val'];
                $_SESSION['people'] = $_SESSION['people'] + $_POST['f_val'];
            }
        }
    }

    //Покупка и продажа земли
    if(isset($_POST['bs_val'], $_POST['bs_action'])) {
        if($_POST['bs_action'] == '+') {
            if(($_SESSION['grain'] - $_POST['bs_val'] * $_SESSION['land_price']) <= 0) {
                $tmp_l = (int)($_SESSION['grain']/$_SESSION['land_price']);
                $tmp_ln = '<br>Максимум хватит на:';
            } else {
                $_SESSION['grain'] = $_SESSION['grain'] - $_POST['bs_val'] * $_SESSION['land_price'];
                $_SESSION['land'] = $_SESSION['land'] + $_POST['bs_val'];
            }

        } elseif($_POST['bs_action'] == '-') {
            if($_POST['bs_val'] > $_SESSION['land']) {
                $tmp_ln = '<br>Нельзя продавать больше чем есть';
            } elseif($_POST['bs_val'] == $_SESSION['land']) {
                $tmp_ln = '<br>А чем править?';
            } else {
                $_SESSION['grain'] = $_SESSION['grain'] + $_POST['bs_val'] * $_SESSION['land_price'];
                $_SESSION['land'] = $_SESSION['land'] - $_POST['bs_val'];
            }
        }
    }

    //Управление количеством воинов
    if(isset($_POST['w_val'], $_POST['w_action'])) {
        if($_POST['w_action'] == '+') {
            if($_POST['w_val'] > $_SESSION['people']) {
                $tmp_w = $_SESSION['people'];
                $tmp_wn = '<br>Максимум можно призвать:';
            } else {
                $_SESSION['warriors'] = $_SESSION['warriors'] + $_POST['w_val'];
                $_SESSION['people'] = $_SESSION['people'] - $_POST['w_val'];
            }

        } elseif($_POST['w_action'] == '-') {
            if($_POST['w_val'] > $_SESSION['warriors']) {
                $tmp_w = $_SESSION['warriors'];
                $tmp_wn = '<br>Максимум можно отпустить:';
            } else {
                $_SESSION['warriors'] = $_SESSION['warriors'] - $_POST['w_val'];
                $_SESSION['people'] = $_SESSION['people'] + $_POST['w_val'];
            }
        }
    }

    //минусование из зерна
    $_SESSION['grain_calc'] = ($_SESSION['needs'] * $_SESSION['people']) + ($_SESSION['needs'] * $_SESSION['farmer']) + ($_SESSION['warriors'] * 5) + ($_SESSION['farmer'] * 0.5);
}

//действия в случае если население оказалось отрицательным
if($_SESSION['people'] < 0){
    $_SESSION['warriors'] = $_SESSION['warriors'] + $_SESSION['people'];
    if($_SESSION['warriors'] > 0){
        $_SESSION['people'] = 0;
    }elseif(($_SESSION['warriors'] < 0) && ($_SESSION['farmer'] > 0)){
        $_SESSION['farmer'] = $_SESSION['farmer'] + $_SESSION['warriors'];
        $_SESSION['warriors'] = 0;
        $_SESSION['people'] = 0;
    }elseif($_SESSION['farmer'] <= 0){
        $end_game = '<p>Нет населения и нет короля.</p><br>
            <img src="img/mogila.jpg"><br>';
    }
}

if(!empty($end_game)){
    $_SESSION['end_game'] = $end_game;
    header('Location: end_game.php');
    exit();
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

    <div style="width: 400px; float: left;">

        <p>Ваше королевство!</p>

        <table border="solid 1px">
            <tr>
                <td width="200">Год правления: <?php echo $_SESSION['year']; ?> год</td>
            </tr>
            <tr>
                <td><b>Зерно: <?php echo (int)$_SESSION['grain']; ?><?php if(isset($_SESSION['grain_calc']) & ($_SESSION['grain_calc'] !== 0)){echo '-'.(int)$_SESSION['grain_calc'];} ?></b></td>
                <td>Урожай: <?php echo $_SESSION['harvest']; ?> буш/акр</td>
            </tr>
            <tr>
                <td>Земли: <?php echo $_SESSION['land']; ?></td>
                <td>Цена на землю <?php echo $_SESSION['land_price']; ?></td>
            </tr>
            <tr>
                <td><b>Население: <?php echo $_SESSION['people']; ?></b></td>
                <td>
                    Беженцы: <?php echo $_SESSION['refugees']; ?><br>
                    Взросление: <?php echo $_SESSION['born']; ?><br>
                    Умерло: <?php echo $_SESSION['die']; ?>
                </td>
            </tr>
            <tr>
                <td>Потребности населения: <?php echo $_SESSION['needs']; ?></td>
            </tr>
            <tr>
                <td>Хлеборобы: <?php echo $_SESSION['farmer']; ?> чел.</td>
                <td>Хлебороб засевает: <?php echo $_SESSION['farmer_harvest']; ?> акр.</td>
            </tr>
            <tr>
                <td>Воины: <?php echo $_SESSION['warriors']; ?> чел.</td>
                <td>
                    Нападающие: <?php echo $_SESSION['enemy']; ?> чел.<br>
                    Расстояние: <?php echo @$_SESSION['distance']; ?> лиг
                </td>
            </tr>
            <tr>
                <td>

                    <?php if($_SESSION['grain'] < $_SESSION['grain_calc']){ echo 'Нельзя потратить больше чем есть!'; }else{
                        echo '
                            <form action="" method="post">
                                <input type="submit" name="step"  value="Следующий год">
                            </form>
                        ';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <form action="" method="post">

                        Потребности населения:<br>
                        <label><input type="radio" name="n_action" value="+" <?php if(isset($_POST['n_action']) && $_POST['n_action'] == '+') {echo 'checked';};?>> Увеличить</label><br>
                        <label><input type="radio" name="n_action" value="-" <?php if(isset($_POST['n_action']) && $_POST['n_action'] == '-') {echo 'checked';};?>> Уменьшить</label><br>
                        <?php echo $tmp_nn;?><input type="text" name="n_val" value="<?php echo (int)$tmp_n;?>"> б/ч<br>

                        Хлеборобы<br>
                        <label><input type="radio" name="f_action" value="+" <?php if(isset($_POST['f_action']) && $_POST['f_action'] == '+') {echo 'checked';};?>> Увеличить</label><br>
                        <label><input type="radio" name="f_action" value="-" <?php if(isset($_POST['f_action']) && $_POST['f_action'] == '-') {echo 'checked';};?>> Уменьшить</label><br>
                        <?php echo $tmp_fn;?><input type="text" name="f_val" value="<?php echo (int)$tmp_f;?>"> чел.<br>

                        Операции с воинами<br>
                        <label><input type="radio" name="w_action" value="+" <?php if(isset($_POST['w_action']) && $_POST['w_action'] == '+') {echo 'checked';};?>> Призвать</label><br>
                        <label><input type="radio" name="w_action" value="-" <?php if(isset($_POST['w_action']) && $_POST['w_action'] == '-') {echo 'checked';};?>> Отпустить</label><br>
                        <?php echo $tmp_wn;?><input type="text" name="w_val" value="<?php echo (int)$tmp_w;?>"> чел.<br>

                        Операции над землей<br>
                        <label><input type="radio" name="bs_action" value="+" <?php if(isset($_POST['bs_action']) && $_POST['bs_action'] == '+') {echo 'checked';};?>> Купить</label><br>
                        <label><input type="radio" name="bs_action" value="-" <?php if(isset($_POST['bs_action']) && $_POST['bs_action'] == '-') {echo 'checked';};?>> Продать</label><br>
                        <?php echo $tmp_ln;?><input type="text" name="bs_val" value="<?php echo (int)$tmp_l;?>"> акров<br>
                        <input type="submit" name="calc"  value="Расчитать">
                    </form>
                </td>
            </tr>
        </table>
    </div>

    <div style="width: 255px; float: left;"><?php echo $notice; ?></div>

    <div style="clear: both"></div>

    <div>

        <br>

        <form action="index.php" method="post">
            <input type="submit" name="restart"  value="Выйти в меню">
        </form>

        <br>
        <br>

    </div>
</div>
</body>
</html>
