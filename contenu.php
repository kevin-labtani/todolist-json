<?php

    $currentJSONTodo = file_get_contents('todo.json');
    $arrayTodo = json_decode($currentJSONTodo, true); // array

    function generateTodos($arrayTodo)
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

?>

        <!-- ADD todo LIST -->
        <div id= "todo-list" class="container section grey lighten-5">
            <div class="row">
                <div class="col s12 m6 offset-m3 z-depth-2">
                    <!-- todo yet to do -->
                    <form action="" method="POST" class="todos">
                        <?php generateTodos($arrayTodo); ?>
                        <p>
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
                        </p>
                        <div class="input-field left-align">
                            <button class="btn waves-effect waves-light orange" type="submit" name="submit" value="submit" disabled>Submit</button>
                        </div>
                    </form>
                    <!-- todo completed -->
                    <h5 id="completed">Completed todos</h5>
                    <form action="" method="" class="completed">
                        <p>
                            <label>
                                <input type="checkbox" checked disabled />
                                <span><del>Eat lunch</del></span>
                            </label>
                        </p>
                    </form>
                </div>
            </div>
        </div>