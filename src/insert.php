<?php
    //Qui la parte di inserimento nel DB degli utenti

    //1. Connessione a MYSQL + gestione degli eventuali errori
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $servername = 'db';
        $username = 'myuser';
        $password = 'mypassword';
        $database = 'myapp_db';

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connessione fallita: " . $conn->connect_error);
        }// else -> connessione riuscita

        $q = "INSERT INTO utenti (nome, email) VALUES ('". $_POST["name"] . "', '". $_POST["email"]."')";
        echo $q;

        if($conn -> query($q)){
            echo "<h1>Connessione riuscita a MySQL!</h1>";
        } else {
            echo "ERRORE!";
        }


        $conn->close();
    }

    //2. Recuperiamo i dati inviati in POST dall'utente
    //3. Costruimo la query SQL

    //INSERT INTO utenti (nome, email) VALUES ("MARIO ROSSI"; "example@gmail.com)
    //Eseguiamo la query e controlliamo il risultato

    //A valle del form visualizzare gli utenti presenti nella tabella
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="form">
        <!-- QUI INSERISCO IL FORM--> 
         <form action="" method="post">
            <label>Inserisci nome e cognome</label>
            <input type="text" name="name">
            <label for="email">Inserisci email</label>
            <input type="text" name="email">
            <input type="submit" value="Inserisci">
         </form>
    </div>
    
    //visualizza utenti
    <div id="users">
        <?php
            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connessione fallita: " . $conn->connect_error);
            }// else -> connessione riuscita

            $q = "SELECT * from utenti";
            echo $q;

            $results = $conn -> query($q);

            $row = $results -> fetch_array(MYSQLI_ASSOC);
            print_r($row);
            echo "<br />";
            $row = $results -> fetch_array(MYSQLI_ASSOC);
            print_r($row);
            echo "<br />";
            $row = $results -> fetch_array(MYSQLI_ASSOC);
            print_r($row);
            echo "<br />";
        ?>
    </div>
</body>
</html>