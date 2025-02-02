<html>
<head>


</head>
<body>


<p><a href="index.php">Wróć do indeksu</a></p>
<h1>Łączenie PHP do SQL przy pomocy PDO</h1>
<a href="https://www.w3schools.com/php/php_mysql_connect.asp">DOKUMENTACJA</a>

<form action="insertsks_del_pdo.php" method="post" >

<h3>Dopisz zawodnika</h3>
    Imię: <input type="text" name="imie"><br>
	Nazwisko: <input type="text" name="nazwisko"><br>
	Klasa: <input type="text" name="klasa"><br>
    <input type="submit" value="zapisz" >
</form>


<?php
/*obsługa bazy przy pomocy PDO
dokumentacja: 
https://www.phptutorial.net/php-pdo/
*/ 


// INSERT DATA
if (isset($_POST["imie"]) && trim($_POST["imie"]) != "" && isset($_POST["nazwisko"]) && trim($_POST["nazwisko"]) != "" && isset($_POST["klasa"]) && trim($_POST["klasa"]) != ""){
	
	// Create connection and check connection
	$servername = "localhost";
	$username = "root";
	$password = "";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully";
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

	$imie = $_POST["imie"];
	$nazwisko = $_POST["nazwisko"];
	$klasa = $_POST["klasa"];

	mysqli_set_charset($conn, "utf8");
	$sql = "INSERT INTO zawodnicy (imie, nazwisko, klasa) VALUES ('$imie','$nazwisko','$klasa')";


	$conn = null;

}


// DELETE DATA

?>

<h3>Aktualnie zapisani zawodnicy</h3>
<ol>
<?php

	//wybierz aktualnie zapisanych zawodników z opcją edutowania

	

?>
</ol>


</body>
</html>