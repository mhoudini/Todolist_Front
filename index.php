<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todo List</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/app.js" defer></script>
</head>

<body>

    <h1>My Todo List</h1>

    <?php

    // Configuration et initialisation
    require_once 'database/config.php';
    require_once 'database/Database.php';
    require_once 'functions/functions.php';

    try {
        // Récupération des données
        $todos = getAllTodos(new Database($config));

        // Affichage des vues
        require_once 'views/view.todos.php';
    } catch (Exception $e) {
        echo "<p>Erreur : " . $e->getMessage() . "</p>";
    }

    ?>

</body>

</html>
