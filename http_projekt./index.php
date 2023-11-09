<?php
$servername = "localhost";
$username = "root";
$password = "Parasolka5";
$dbname = "matrix";

// Pobieranie wartości X z formularza
$X = isset($_POST['X']) ? (int)$_POST['X'] : 0;

// Tworzenie połączenia z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Sprawdzanie połączenia z bazą danych
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Zapytanie do bazy danych z filtrem
$sql = "SELECT nazwa_kursu, liczba_studentow, procent_ukonczonych FROM warsztaty WHERE liczba_studentow > $X AND procent_ukonczonych > $X";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Filtr Kursów</title>
</head>
<body>

<!-- Formularz do wprowadzenia wartości X -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  Wyświetl kursy, których X% studentów ukończyło szkolenie: <input type="number" name="X" value="<?php echo $X; ?>">
  <input type="submit" value="Filtruj">
</form>
<br>

<?php
// Wyświetlanie danych w formie tabeli
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Kurs</th><th>Liczba Studentów</th><th>% studentów, którzy ukończyli kurs</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nazwa_kursu"] . "</td><td>" . $row["liczba_studentow"] . "</td><td>" . $row["procent_ukonczonych"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Brak danych";
}

// Zakończenie połączenia z bazą danych
$conn->close();
?>

</body>
</html>

