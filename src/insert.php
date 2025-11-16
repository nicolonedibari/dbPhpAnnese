<?php
    //Qui la parte di inserimento nel DB degli utenti
    $servername = 'db';
    $username = 'myuser';
    $password = 'mypassword';
    $database = 'myapp_db';

    // --- INSERIMENTO UTENTE ---
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["name"]) && !isset($_POST["delete_id"])){

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        // NOTA: nella tabella il campo si chiama "nome", NON "name"
        $q = "INSERT INTO utenti (nome, email) VALUES ('". $_POST["name"] . "', '". $_POST["email"]."')";
        
        if($conn -> query($q)){
            echo "<h1>Utente inserito correttamente!</h1>";
        } else {
            echo "ERRORE!";
        }

        $conn->close();
    }

    // --- CANCELLAZIONE UTENTE ---
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["delete_id"])) {

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }

        $delete_id = $_POST["delete_id"];
        $q = "DELETE FROM utenti WHERE id = $delete_id";

        $conn->query($q);
        $conn->close();

        echo "<h3>Utente eliminato!</h3>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- FORM INSERIMENTO -->
    <div id="form">
        <form action="" method="post">
            <label>Inserisci nome e cognome</label>
            <input type="text" name="name">

            <label for="email">Inserisci email</label>
            <input type="email" name="email">

            <input type="submit" value="Inserisci">
        </form>
    </div>
    
    <!-- visualizza utenti -->
    <div id="users">

        <?php
            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connessione fallita: " . $conn->connect_error);
            }

            $q = "SELECT * FROM utenti";
            $results = $conn->query($q);
        ?>

        <h2>Lista utenti</h2>

        <table border="1" cellpadding="6">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Azioni</th>
            </tr>

            <?php
                if ($results && $results->num_rows > 0) {

                    while ($row = $results->fetch_array(MYSQLI_ASSOC)) {

                        echo "<tr>";
                        echo "<td>". $row["nome"] . "</td>";
                        echo "<td>". $row["email"] . "</td>";
                        echo "<td>
                                <form method='post' action=''>
                                    <input type='hidden' name='delete_id' value='". $row["id"] ."'>
                                    <input type='submit' value='Elimina'>
                                </form>
                              </td>";
                        echo "</tr>";
                    }

                } else {
                    echo "<tr><td colspan='3'>Nessun utente trovato</td></tr>";
                }

                $conn->close();
            ?>
        </table>

    </div>
</body>
</html>
