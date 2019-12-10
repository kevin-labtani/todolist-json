<?php
    // reads JSON file into a string
    $currentJSONTodo = file_get_contents('todo.json');
    // decode JSON encoded string into an array
    $arrayTodo = json_decode($currentJSONTodo, true);

    // filter incomplete todos into their own array
    $arrayIncompleteTodo = array_filter($arrayTodo, function ($todo) {
        return false === $todo['completed'];
    });

    // filter complete todos into their own array
    $arrayCompleteTodo = array_filter($arrayTodo, function ($todo) {
        return true === $todo['completed'];
    });

    // generate incomplete todos view
    function generateIncompleteTodos($arrayTodo)
    {
        foreach ($arrayTodo as $todo) {
            echo '
            <p draggable="true" class="draggable" >
                <label>
                    <input type="checkbox"  class="toDo" />
                    <span>'.$todo['task'].'</span>
                </label>
            </p>';
        }
    }

    // generate complete todos view
    function generateCompleteTodos($arrayTodo)
    {
        foreach ($arrayTodo as $todo) {
            echo '
                <p>
                    <label>
                        <input type="checkbox" checked disabled />
                        <span><del>'.$todo['task'].'</del></span>
                    </label>
                </p>';
        }
    }
    ?>
<?php
    //Get and modify the JSON file ("completed")
    if (isset($POST['submit'])) {
        
    } 
?>

        <!-- ADD todo LIST -->
        <div id= "todo-list" class="container section grey lighten-5">
            <div class="row">
                <div class="col s12 m6 offset-m3 z-depth-2">
                    <!-- incomplete todos -->
                    <form action="" method="POST" class="todos">
                    <div id="toDoList">
                        <?php generateIncompleteTodos($arrayIncompleteTodo); ?> 
                    </div>
                        <div class="input-field left-align">
                            <button class="btn waves-effect waves-light orange" type="submit" name="submit" value="submit" id="submit" disabled>Submit</button>
                        </div>
                    </form>
                    <!-- complete todos -->
                    <h5>Completed todos</h5>
                    <div class="completed">
                        <?php generateCompleteTodos($arrayCompleteTodo); ?>
                    </div>
                </div>
            </div>
        </div>
    <script src="assets/js/script.js"></script>