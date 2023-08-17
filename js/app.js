document.addEventListener('DOMContentLoaded', function() {

    // Sélection des éléments du DOM
    const todoBtn = document.querySelector("#todo");
    const doneBtn = document.querySelector("#done");
    const allBtn = document.querySelector("#all");
    const todos = document.querySelectorAll("#todos article");
    const todoForm = document.querySelector('#addTodo form');
    const todoCheckboxes = document.querySelectorAll('#todos article input[type="checkbox"]');

    // Fonction pour afficher/masquer les tâches basées sur leur statut
    function filterTodos(status) {
        for (const todo of todos) {
            const isCompleted = todo.dataset.completed === "true";
            if (status === "done" && !isCompleted || status === "todo" && isCompleted) {
                todo.classList.add("hide");
            } else {
                todo.classList.remove("hide");
            }
        }
    }

    // Écouteurs d'événements pour les boutons de filtrage
    doneBtn.addEventListener("click", () => filterTodos("done"));
    todoBtn.addEventListener("click", () => filterTodos("todo"));
    allBtn.addEventListener("click", () => filterTodos("all"));

    // Gérer la soumission du formulaire pour ajouter des tâches
    todoForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(todoForm);
        fetch('add_todo.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de l\'ajout de la tâche.');
            }
        })
        .catch(error => {
            alert('There was a problem with the fetch operation: ' + error.message);
        });
    });

    // Gérer le changement de la case à cocher pour mettre à jour l'état de la tâche
    todoCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const todoId = this.dataset.id;
            const status = this.checked ? 1 : 0;
            fetch('update_todo.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: todoId, status: status })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (!data.success) {
                    alert('Erreur lors de la mise à jour de la tâche.');
                }
            })
            .catch(error => {
                alert('There was a problem with the fetch operation: ' + error.message);
            });
        });
    });
});
