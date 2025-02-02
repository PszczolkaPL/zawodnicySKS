<!DOCTYPE html>
<html>

<head>
<style>
html {
	scroll-behavior: smooth;
	font-family: Arial, Helvetica, sans-serif;
	background-image: linear-gradient(to right, #9AD5CA , #ADB9E3);
}
h1 {
  text-decoration-line: overline;
  text-decoration-color: purple;
  opacity: 0;
  transform: translateY(20px);
  animation: fadeInUp 2s forwards;  
}
li:hover{
	background: #ADB9E3;
}
li {
  margin: 0 0 10px 0; 
}
@keyframes fadeInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}


</style>
</head>

<body>

<div id="wstep">
<h1>Trzy sposoby łaczenia z DB przy pomocy PHP</h1>

	<p>Stwórz bazę danych w <a target="_blank" href="http://localhost/phpmyadmin">phpmyadmin</a>  według <a href="#schemat">schematu</a>. 
	<p>Obejrzyj jak działają <a href="#polaczenia">3 sposoby połączenia z bazą danych</a> przy pomocy PHP</p>
	<p>Wykonaj zadania: <a href="#zadaniadowykonania">Zadania do wykonania</a></p>

	<img id="schemat" src="zawodnicy.png"></img>


</div>

<h1 id="polaczenia">3 sposoby łączenia PHP z SQL</h1>
<ol>
	<li><a href='insertsks_del.php'>połączenie strukturalne przy pomocy biblioteki mysqli (Sposób polecany na egzaminie INF.03), popatrz na tabelkę z dokumentacją powyżej</a> </li>
	<li><a href='insertsks_del_obj.php'>połączenie obiektowe (->) przy pomocy mysqli, użycie znaku -></a> </li>
	<li><a href='insertsks_del_pdo.php'>połączenie PDO</a> </li>
	</ol>
<h1 id='zadaniadowykonania'>Poniżej znjdują się ZADANIA do wykonania w Waszej grupie (2os)</h1>
<ol>
	<li>Dodajcie metody zapisania/usunięcia i edytowania zawodnika w jednym wybranym <a href="#polaczenia">sposobie</a></li>
	<li>Sprawźcie czy działają polskie znaki przy zapisywaniu/odczytywaniu/edytowaniu. Jeśli coś nie działa, poprawcie to w kodzie.</li>
	<li>Dodajcie pole do formularza zapisu/edycji, np. rok urodzenia i obsłuż wstawianie/edytowanie  razem z tym polem</li>
	<li>Zoptymalizujcie i uporządkujcie kod, aby nie trzeba było dodawać zmian w tak wielu miejscach</li>
	<li>Poczytajcie dokumentację połączenia przy pomocy PDO i jeśli chcecie uzupełnijcie wstawianie/usuwanie/edytowanie przy pomocy PDO </li>
	<li>Poprawcie logikę aplikacji w połączeniu strukturalnym. Np. w sytuacji, kiedy używamy strzałki wstecz w przeglądarce - kasują się dane  </li>
	<li>Załóżcie na bazie użytkownika (create user), który ma prawa do zapisywania/edytowania/usuwnia zawodników oraz innego, który ma prawa tylko do odczytywania zapisanych zawodników.</li>
	<li>Wszystkie swoje rozwiązania zaprezentujcie podczas krótkiej dyskusji w klasie</li>
</ol>


</body>
</html>