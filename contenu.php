<?php

    $currentJSONTodo = file_get_contents('todo.json');
    $arrayTodo = json_decode($currentJSONTodo, true); // array

    $arrayIncompleteTodo = array_filter($arrayTodo, function ($todo) {
        return false === $todo['completed'];
    });

    $arrayCompleteTodo = array_filter($arrayTodo, function ($todo) {
        return true === $todo['completed'];
    });

    function generateIncompleteTodos($arrayTodo)
    {
        foreach ($arrayTodo as $todo) {
            echo '
                <p>
                    <label>
                        <input type="checkbox" />
                        <span>'.$todo['task'].'</span>
                    </label>
                </p>';
        }
    }

    function generateCompleteTodos($arrayTodo)
    {
        foreach ($arrayTodo as $todo) {
            echo '
                <p>
                    <label>
                        <input type="checkbox" checked disabled />
                        <span><del>'.$todo['task'].'<del></span>
                    </label>
                </p>';
        }
    }

?>

        <!-- ADD todo LIST -->
        <div id= "todo-list" class="container section grey lighten-5">
            <div class="row">
                <div class="col s12 m6 offset-m3 z-depth-2">
                    <!-- todo yet to do -->
                    <form action="" method="POST" class="todos">
                        <?php generateIncompleteTodos($arrayIncompleteTodo); ?>
                        <!-- <p>
                            <label>
                                <input type="checkbox" />
                                <span>Complete todo challenge</span>
                            </label>
                        </p>
                        <p>
                            <label>
                                <input type="checkbox" checked/>
                                <span>Go to sleep early</span>
                            </label>
                        </p> -->
                        <div class="input-field left-align">
                            <button class="btn waves-effect waves-light orange" type="submit" name="submit" value="submit" disabled>Submit</button>
                        </div>
                    </form>
                    <!-- todo completed -->
                    <h5>Completed todos</h5>
                    <div class="completed">
                        <?php generateCompleteTodos($arrayCompleteTodo); ?>
                        <!-- <p>
                            <label>
                                <input type="checkbox" checked disabled />
                                <span><del>Eat lunch</del></span>
                            </label>
                        </p> -->
                    </div>
                </div>
            </div>
        </div>