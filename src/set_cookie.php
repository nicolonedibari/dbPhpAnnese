<?php

    $scadenza = time() + 60 * 60 * 24 * 7; // 1 settimana

    setcookie("username", $_POST["username"], $scadenza);
    setcookie("theme", $_POST["theme"], $scadenza);
    header("Location: cookies_settati.php");

    //2 file: uno che contiene un form con 2 campi: 
        // Text con username
        //select con preferenza theme (chiaro o scuro)
        //lutente invia i dati e il server memoriza le scelte dell'utente per 1 settimana
        // importante l'action del form deve rimandare ad una pagina php che contiene solo: 
            // chiamate a set cookie
            // chiamate a header ("location...)
        // dopo il redirect l'utente visualizza in una pagina web dedcata:
        //- un messaggio di benvenuto con lo username, 
        // - la pagina con sfondo scuro o chiaro (e testi chiari o scuri a seconda della scelta tematica)
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Form preferenze</title>
</head>
<body>

<h1>Inserisci le tue preferenze</h1>

<form method="post">
    <label>
        Username:
        <input type="text" name="username" required>
    </label>
    <br><br>

    <label>
        Tema:
        <select name="theme">
            <option value="white">Bianco</option>
            <option value="dark">Negro</option>
            <option value="red">Rosso</option>
            <option value="green">Verde</option>
            <option value="brown">Marrone</option>
        </select>
    </label>
    <br><br>

    <button type="submit">Invia</button>
</form>

</body>
</html>
