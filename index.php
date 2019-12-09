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
        
        <title>Todolist</title>
    </head>
    <body class="grey lighten-3">

        <?php require 'contenu.php'; ?>
        <?php require 'formulaire.php'; ?>

        
        <!--JavaScript at end of body for optimized loading-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            // init materialize js stuff
            document.addEventListener("DOMContentLoaded", function() {
                M.AutoInit();
            });
            // init char counters for fields with max length
            var textNeedCount = document.querySelectorAll('#new-todo');
            M.CharacterCounter.init(textNeedCount);
    </script>
    </body>
</html>