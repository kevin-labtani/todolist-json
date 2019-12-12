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
                    <input id="' . $todo['id'] . '" type="checkbox"  name="task[]" class="toDo" value="'.$todo['task'].'" />
                    <span >'.$todo['task'].'</span>
                </label>
            </p>';
        }
    }

    // generate complete todos view
    function generateCompleteTodos($arrayTodo)
    {
        foreach ($arrayTodo as $todo) {
            echo '
                <p class="draggable" draggable="true">
                    <label>
                        <input id="' . $todo['id'] . '" type="checkbox" checked disabled />
                        <span><del>'.$todo['task'].'</del></span>
                    </label>
                </p>';
        }
    }
//     // print_r($_REQUEST);
//     echo ($_REQUEST['xhr']);
//  $todoData = $_REQUEST['todoData'];
//  print_r($_REQUEST['data']);
//  print_r($_REQUEST['submit']);
//  if (isset($_POST['data'])) {
//     $json = file_get_contents('php://input');
//         $obj = json_decode($json);
//         echo ($obj);
//      echo 'hello';
//     $todoData = $_REQUEST['todoData'];
//     print_r($_REQUEST['data']);
//     print_r($_REQUEST['submit']);
//     print_r($_REQUEST);
//     $json = file_get_contents('php://input');
// $obj = json_decode($json);
// echo ($obj->id);
//  };
//  echo $_POST;
//  print_r($_POST);
//     print_r($data1);

// var_dump($_POST);
// if(isset($_POST['submit'])){
// var_dump($_POST);
// echo "hello";
// }
// if($_SERVER['REQUEST_METHOD'] === 'POST') {
//     var_dump($_POST);
// } else {
//     alert("no");
// };
if(!empty($_POST['data'])){
    var_dump($_POST['data']);
}
if (isset($_POST['submit'])) {
    $task = "";
    $task = $_POST['task'];
    $currentJSONTodo = file_get_contents('todo.json');
    echo $currentJSONTodo;
    $arrayTodo = json_decode($currentJSONTodo, true);
    for ($y = 0; $y < count($task); $y++){
        for ($i = 0; $i < count($arrayTodo); $i++) {
            if ($arrayTodo[$i][task] == $task[$y]) {
                $arrayTodo[$i][completed] = true;
            }
        }
    }
    $updated = json_encode($arrayTodo);
    if (file_put_contents('todo.json', $updated)) {
        echo ('yes');
    }
}
?>
<?php 
// $h = $_POST('data');
// if($_POST('data') !== NULL){
//     echo 'hello';
//     // $myarray = &$_POST;
//     // $var = $myarray;
//     // echo $myarray;
//     // print_r($var);
//     // $json = file_get_contents('php://input');
//     // $obj = json_decode($json);
//     // echo ($obj);
// };

//  $todoData = $_POST['data'];
//  echo $todoData;
// //  header("Content-Type: application/json; charset=utf-8");
//  // $data1 = json_decode(file_get_contents('php://input'));
//  $reponse = array($todoData);
//  echo json_decode($reponse);
?>
        <!-- ADD todo LIST -->
        <div id= "todo-list" class="container section grey lighten-5">
            <div class="row">
                <div class="col s12 m6 offset-m3 z-depth-2">
                    <!-- incomplete todos -->
                    <form action="" method="POST" class="todos" id="todos">
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