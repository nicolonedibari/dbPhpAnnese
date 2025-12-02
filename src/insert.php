<?php
    include_once("index.php");

    // inserire
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_user"])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        $conn->query("INSERT INTO utenti (nome, email) VALUES ('$nome', '$email')");
    }

    // cancellare
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
        $id = $_POST["delete_id"];
        $conn->query("DELETE FROM utenti WHERE id = $id");
    }

    // modificare
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_id"])) {
        $id = $_POST["update_id"];
        $nome = $_POST["edit_nome"];
        $email = $_POST["edit_email"];

        $conn->query("UPDATE utenti SET nome = '$nome', email = '$email' WHERE id = $id");
    }

    // leggi
    $utenti = get_users();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Utenti</title>

    <style>
        .hidden {
            display: none;
        }

        table {
            border-collapse: collapse;
        }

        td, th {
            padding: 6px;
        }

       .edit-form input {
            width: 95%;
        }

        button {
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Inserisci nuovo utente</h2>

<!-- inserire -->
<form method="post" action="">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="submit" name="add_user" value="Inserisci">
</form>

<h2>Elenco utenti</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Azioni</th>
    </tr>

<?php 
    foreach ($utenti as $row) {
?>

    <!-- VISUALIZZAZIONE -->
    <tr id="row-<?= $row['id'] ?>">
        <td><?= $row["id"] ?></td>
        <td><?= $row["nome"] ?></td>
        <td><?= $row["email"] ?></td>
        <td>
            <button class="editBtn" data-target="<?= $row['id'] ?>">
                Modifica
            </button>

            <form method="post" action="">
                <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                <input type="submit" value="Elimina">
            </form>
        </td>
    </tr>

    <!-- MODIFICA -->
    <tr id="edit-<?= $row['id'] ?>" class="hidden edit-form">
        <form method="post" action="">
            <input type="hidden" name="update_id" value="<?= $row['id'] ?>">

            <td><?= $row["id"] ?></td>
            <td>
                <input type="text" name="edit_nome" value="<?= $row["nome"] ?>">
            </td>
            <td>
                <input type="email" name="edit_email" value="<?= $row["email"] ?>">
            </td>
            <td>
                <input type="submit" value="Salva">
            </td>
        </form>
    </tr>

<?php 
    } 
?>

</table>

<script>
    let buttons = document.querySelectorAll(".editBtn");

    buttons.forEach(function(element, index, array) {
        element.addEventListener("click", function () {
            let id = element.dataset.target;

            document.getElementById("row-" + id).classList.add("hidden");
            document.getElementById("edit-" + id).classList.remove("hidden");
        });
    });
</script>

</body>
</html>

<?php
    $conn->close();
?>
