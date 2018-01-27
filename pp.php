<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Language" content="ru">
<META http-equiv="Content-Script-Type" content="type">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title></title>
</head>

<body>


<?php
// 27/01/18
// Выполнение всех действий. Универсальная процедура. В зависимости от режима(радио-переключателя).

//получ. значения параметров в переменные:
$nId = $_GET['n_Id'];
$sName = $_GET['s_Name'];
$t1 = $_GET['t_1'];


echo 'параметры: ';
echo '<br>';

echo 'nId = ';
if ($nId=='')
{
	echo '<не задан>';
}
echo $nId;
echo '<br>';

echo 'sName = ';
if ($sName=='')
{
	echo '<не задан>';
}
echo $sName;
echo '<br>';

echo 't1 = ';
echo $t1;
echo '<br>';

echo '<br>';

//mysql_query("SET NAMES utf8");


// Соединяемся, выбираем базу данных:
$link = mysqli_connect('localhost', 'evatrobd_knn4000', 'qhuB8xc4', 'evatrobd_knn4000');

// Check connection:
if (!$link)
{
	die("Ошибка: Не удалось соединиться с базой данных.: " . mysqli_connect_error());
}
//echo 'Соединение успешно установлено';

if ($t1==1)
{

echo 'Вывод данных из БД:';
if ($sName=='')
{
	echo '  <все>';
}
else
{
	echo '  <фильтр>';
}
echo '<br>';

// Найти в табл.заданий все невыполненные задания:
$result = mysqli_query($link, "call p1('$sName')") or die('Ошибка2: Запрос не удался: ' . mysql_error());

//сканировать строки сего SQL-запроса:
while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC))  //сканируем набор записей
{
	// вывести (отобразить на стороне клиента):
	echo $line['id'];
	echo " | ";
	echo $line['name'];

	echo '<br/>';
}

// Освобождаем память от результата:
mysqli_free_result($result);

}

if ($t1==2)
{
	echo 'Добавление или изменение записи в БД:';
	echo '<br/>';

	if ($nId=='')
	{
		$nId=0;
	}


	$result = mysqli_query($link, "call p2($nId, '$sName')") or die('Ошибка3: Запрос не удался: ' . mysql_error());

	echo 'осуществлено.';
	echo '<br/>';
}

if ($t1==3)
{
	echo 'Удаление записи из БД:';
	echo '<br/>';

	if ($nId=='')
	{
		$nId=0;
	}

	$result = mysqli_query($link, "call p3($nId)") or die('Ошибка4: Запрос не удался: ' . mysql_error());

	echo 'осуществлено.';
	echo '<br/>';
}

echo '<br/>';

// Закрываем соединение:
mysqli_close($link);

?>

======================

</body>
</html>
