<?php
    // Config DB
    $servername = 'db';
    $username   = 'myuser';
    $password   = 'mypassword';
    $database   = 'myapp_db';

    // Connessione
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    // --- ELIMINAZIONE ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])){

        $id = $_POST["delete_id"];
        $q = "DELETE FROM utenti WHERE id = $id";
        $conn->query($q);
    }

    // --- INSERIMENTO ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && isset($_POST["email"]) && !isset($_POST["delete_id"])) {

        $nome  = $_POST["name"];
        $email = $_POST["email"];

        $q = "INSERT INTO utenti (nome, email) VALUES ('$nome', '$email')";
        $conn->query($q);
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestione utenti</title>
</head>
<body>

    <h2>Inserisci Utente</h2>
    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="name">

        <label>Email:</label>
        <input type="email" name="email">

        <input type="submit" value="Inserisci">
    </form>

    <hr>

    <h2>Elenco utenti</h2>

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Azione</th>
        </tr>

        <?php
            //query tabella utenti
            $q = "SELECT * FROM utenti";
            $results = $conn->query($q);

            if ($results && $results->num_rows > 0) {
                while ($row = $results->fetch_assoc()) {
        ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["nome"] ?></td>
                        <td><?= $row["email"] ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="delete_id" value="<?= $row["id"] ?>">
                                <input type="submit" value="Elimina">
                            </form>
                        </td>
                    </tr>
        <?php
                }
            } else {
                echo "<tr><td>Nessun utente presente.</td></tr>";
            }

            $conn->close();
        ?>
    </table>

</body>
</html>
