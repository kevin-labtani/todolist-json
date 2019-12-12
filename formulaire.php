<?php
    // init variables and errors
    $newTodo = '';
    $errors = ['newTodo' => ''];

    // check for submission
    if (isset($_POST['add'])) {
        // assign var
        $newTodo = $_POST['newTodo'];

        // validate and sanitize input
        if (empty(trim($_POST['newTodo']))) {
            $errors['newTodo'] = 'Please enter a new Todo';
        } elseif (strlen($_POST['newTodo']) > 50) {
            $errors['newTodo'] = 'The maximum allowed length is 50 characters';
        } else {
            $newTodo = filter_var($_POST['newTodo'], FILTER_SANITIZE_STRING);
        }

        // write to json
        // sudo chmod -R 777 todo.json
        if (!array_filter($errors)) {
            // reads JSON file into a string
            $currentJSONTodo = file_get_contents('todo.json');
            // decode JSON encoded string into an array
            $arrayTodo = json_decode($currentJSONTodo, true);
            // prep new task object for appending to file
            $append = [
                'id' => sizeof($arrayTodo),
                'task' => $newTodo,
                'completed' => false,
            ];
            $arrayTodo[] = $append;
            // encode back to JSON and then write to file
            $updatedArrayTodo = json_encode($arrayTodo);
            if (file_put_contents('todo.json', $updatedArrayTodo)) {
                $newTodo = '';
            }
        }
    }

?>
        <!-- ADD todo FORM -->
        <div id= "todo-form" class="container section grey lighten-5">
            <h2 class="center-align">Todo List</h2>
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <form action="index.php" method="POST" class="add-todo">
                        <!-- new todo-->
                        <div class="input-field">
                            <label for="newTodo" class="grey-text text-darken-4">Enter new todo</label>
                            <textarea
                                name="newTodo"
                                class="materialize-textarea validate"
                                id="newTodo"
                                data-length="50"
                                required
                            ><?php echo $newTodo; ?></textarea>
                            <div class="red-text"><?php echo $errors['newTodo'] ?? ''; ?></div>
                        </div>
                        <div class="input-field center">
                            <button class="btn waves-effect waves-light orange" type="submit" name="add" value="add">Add New Todo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>