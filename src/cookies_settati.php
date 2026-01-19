<?php
    $username = $_COOKIE["username"];
    $theme = $_COOKIE["theme"];

    if ($theme === "dark") {
        $background = "#222";
        $text = "#fff";
    } elseif ($theme === "white") {
        $background = "#fff";
        $text = "#000";
    } elseif ($theme === "red") {
        $background = "#FF0000";
        $text = "#000";
    } elseif ($theme === "green") {
        $background = "#00FF00";
        $text = "#000";
    } elseif ($theme === "brown") {
        $background = "#9B673C";
        $text = "#000";
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Pagina utente</title>
    <style>
        body {
            background-color: <?php echo $background ?>;
            color: <?php echo $text ?>;
        }
    </style>
</head>
<body>

<h1>Benvenuto, <?php echo $username;?></h1>

</body>
</html>
