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

function get_users ($read_query = "SELECT * FROM utenti;"){
    global $conn;
    $results = $conn->query($read_query);

    $array = [];

    while ($row = $results->fetch_array()) {
        array_push($array, $row);
    }

    return $array;
}
?>
