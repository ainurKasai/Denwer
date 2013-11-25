<?php

include 'Z:\home\localhost\www\sql\lib\Twig\AutoLoader.php';
Twig_Autoloader::register();



 
/* Соединяемся с базой данных */
$hostname = "localhost"; // название/путь сервера, с MySQL
$username = "root"; // имя пользователя (в Denwer`е по умолчанию "root")
$password = ""; // пароль пользователя (в Denwer`е по умолчанию пароль отсутствует, этот параметр можно оставить пустым)
$dbName = "user"; // название базы данных
 
/* Таблица MySQL, в которой будут храниться данные */
$table = "user_information";
 

mysql_connect($hostname, $username, $password) or die ("Не могу создать соединение");
 
/* Выбираем базу данных. Если произойдет ошибка - вывести ее */
mysql_select_db($dbName) or die (mysql_error());
 
/* Определяем текущую дату */
$cdate = date("Y-m-d");
 
/* Составляем запрос для вставки информации в таблицу
name...date - название конкретных полей в базе;
в $_POST["test_name"]... $_POST["test_mess"] - в этих переменных содержатся данные, полученные из формы */
$query = "SELECT * FROM USER_INFORMATION";
 
/* Выполняем запрос. Если произойдет ошибка - вывести ее. */
$res = mysql_query($query) or die(mysql_error());
 
$arr = array();
$index = 0;
while ($row = mysql_fetch_array($res)) {

$arr = array('name' => $row['name'], 'surname'=> $row['surname'], 'patronymic'=> $row['patronymic'], 
'age' => $row['age'], 'class'=> $row['class'], 'faculty' => $row['faculty']);
}




try{

$loader = new Twig_Loader_Filesystem('templates');

$twig = new Twig_Environment($loader);

$template = $twig->loadTemplate('exit.htm');


echo $template->render(array(
'arr'=> $arr
));
}
catch(Exception $e){
die('ERROR'.$e->getMessage());
}
?>