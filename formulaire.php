<?php
    // init variables and errors
    $newTodo = '';
    $errors = ['newTodo' => ''];
    $file = 'todo.json';

    // check the newTodo and sanitize then entry
    if (isset($_POST['add'])) {
        $newTodo = $_POST['newTodo'];

        if (empty($_POST['newTodo'])) {
            $errors['newTodo'] = 'Please enter a new Todo';
        } elseif (strlen($_POST['newTodo']) > 100) {
            $errors['newTodo'] = 'The maximum allowed length is 100 characters';
        } else {
            $newTodo = filter_var($_POST['newTodo'], FILTER_SANITIZE_STRING);
            echo $newTodo;
        }
    }

    if (!array_filter($errors)) {
        // encode to json
        $encodedTodo = json_encode($newTodo);


        // 'a+'	Open for reading and writing; place the file pointer at the end of the file. If the file does not exist, attempt to create it.
        // sudo chmod -R 777 todo.json
        $handle = fopen($file, 'a+');
        // write new todo to the file
        fwrite($handle, "{$encodedTodo}");

        // close file once we're done
        fclose($handle);
    }

?>
<!-- ADD todo FORM -->
        <div id= "" class="container section grey lighten-5">
            <h4 class="center-align">Add a new todo</h4>
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <form action="" method="POST" class="add-todo">
                        <!-- new todo-->
                        <div class="input-field">
                            <label for="newTodo" class="grey-text text-darken-4">Enter new todo</label>
                            <textarea
                                name="newTodo"
                                class="materialize-textarea validate"
                                id="newTodo"
                                data-length="100"
                                required
                            ><?php echo $newTodo; ?></textarea>
                            <div class="red-text"><?php echo $errors['newTodo'] ?? ''; ?></div>
                        </div>
                        <div class="input-field center">
                            <button class="btn-large waves-effect waves-light orange" type="submit" name="add" value="add">Add New Todo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>