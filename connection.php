<?
// Данные для mysql сервера
$dbhost = "localhost"; // Хост
$dbuser = "root"; // Имя пользователя
$dbpassword = ""; // Пароль
$dbname = "kingdom"; // Имя базы данных

$link = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
mysqli_set_charset($link,'utf8');

function q($query) {
    global $link;
    $res = mysqli_query($link, $query);
    if($res === false) {
        $info = debug_backtrace();
        $error = "QUERY: ".$query."<br>\n".mysqli_error($link)."<br>\n".
            "file: ".$info[0]['file']."<br>\n".
            "line: ".$info[0]['line']."<br>\n".
            "date: ".date("Y-m-d H:i:s")."<br>\n".
            "====================================";
        file_put_contents('z:/home/test1.ru/www/KingdomOfGrain/mysql.log', strip_tags($error)."\n\n",FILE_APPEND);
        echo $error;
        exit();
    } else {
        return $res;
    }
}

