<?php
include 'auth.php'; // Извлечение логина и пароля к MYSQL $login, $password
include 'extstat.php';
//include 'translit.php'; # Функция latrus()

// Подключаемся к базе
mysql_connect("127.0.0.1", $login, $password) or die(mysql_error());
mysql_select_db("asterisk") or die(mysql_error());

// Собираем из кусочков полный текст запроса к базе
$strSQL = 
("
        select extension,name,sipname 
        from users 
	order by cast(extension AS SIGNED INTEGER)
");

// Выполняем запрос
$rs = mysql_query($strSQL);

//echo "<table border='1' >";
//echo "<tr><th>Номер<th>Префикс<th>Имя<th>Состояние<th>Действие</td>";

// Извлекаем значения и формируем таблицу результатов
while($id=mysql_fetch_row($rs))
        {
	$clid=explode('-',$id[1]);
	if($clid[0] != end($clid)){$pref=$clid[0];} else {$pref='';}
//print
        echo 
//	"<tr>".
//	"<td>"
$id[0].';'.$id[1]."\n";

//	"<td>".$pref.
//	"<td title=\"".$id[1]."\">".latrus(end($clid)).
 //       "<td>".ExtStatus($id[0]).
//	"<td><a href=orgntform.php?to=".$id[0]." target='call'>звонить</a>";
        }
//echo "</table>";

?>
