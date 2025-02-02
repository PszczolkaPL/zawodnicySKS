<html>
<head>
</head>
<body>
<p><a href="index.php">Wróć do indeksu</a></p>
<h1>Łączenie PHP do SQL przy pomocy mysqli obiektowo</h1>
<a href="https://www.w3schools.com/php/php_mysql_connect.asp">DOKUMENTACJA</a>

<form action="insertsks_del_obj.php" method="post" >

<h3>Dopisz zawodnika</h3>
    Imię: <input type="text" name="imie"><br>
	Nazwisko: <input type="text" name="nazwisko"><br>
	Klasa: <input type="text" name="klasa"><br>
    <input type="submit" value="zapisz" >
</form>


<?php
/*obsługa bazy przy pomocy zapytań obiektowych (użycie ->), 
dokumentacje do tego sposobu znajdziecie w dokumentacji 
do egzaminu
dokumentacja:
na początek przeczytaj dokumentację tworzenia obiektów: 
https://www.w3schools.com/php/php_oop_classes_objects.asp
 
INSERT https://www.w3schools.com/php/php_mysql_insert.asp
DELETE: https://www.w3schools.com/php/php_mysql_delete.asp
SELECT https://www.w3schools.com/php/php_mysql_select.asp
*/ 


// wstaw zawodnka
//usun zawodnika 
?>

<h3>Aktualnie zapisani zawodnicy</h3>
<ol>
<?php
	//wypisanie aktualnie zapisanych zawodników z opcją edytowania na 6
?>
</ol>


</body>
</html>