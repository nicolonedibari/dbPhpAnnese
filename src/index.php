<?php
// config DB
$servername = 'db';
$username   = 'myuser';
$password   = 'mypassword';
$database   = 'myapp_db';

// connessione
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connessione fallita");
}

// QUERY
$query = "SELECT * FROM utenti";
$result = $conn->query($query);

// ARRAY CON TUTTI GLI UTENTI
$utenti = [];

foreach ($result as $row) {
    $utenti[] = $row;
}
?>
