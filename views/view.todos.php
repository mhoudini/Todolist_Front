<div id="todos">

    <div id="addTodo">
        <form action="add_todo.php" method="post">
            <input type="text" name="title" placeholder="Titre de la tâche" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>

    <div id="filters">
        <button id="todo">A faire</button>
        <button id="done">Terminé</button>
        <button id="all">Tout</button>
    </div>

    <?php foreach ($todos as $todo) { ?>
        <article data-completed=<?php echo 0 === $todo->status ? 'false' : 'true'; ?>>
            <label>
                <input type="checkbox" data-id="<?php echo $todo->id; ?>" <?php echo $todo->status ? 'checked' : ''; ?>>
                <?php echo $todo->title; ?>
            </label>
            <p>Complétée : <?php echo 0 === $todo->status ? 'Non' : 'Oui'; ?></p>
        </article>
    <?php } ?>

</div>
