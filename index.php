<?php

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="./assets/css/style.css" />
        
        <title>Todo list</title>
    </head>
    <body class="grey lighten-3">

        <?php require 'formulaire.php'; ?>
        <?php require 'contenu.php'; ?>
        
        <!--JavaScript at end of body for optimized loading-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            // init materialize js stuff
            document.addEventListener("DOMContentLoaded", function() {
                M.AutoInit();
            });
            // init char counters for fields with max length
            var textNeedCount = document.querySelectorAll('#newTodo');
            M.CharacterCounter.init(textNeedCount);
    </script>
    <script src="assets/js/script.js"></script>
    </body>
</html>