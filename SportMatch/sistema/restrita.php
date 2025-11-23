<?php
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../config.php';

    if( (!isset($_SESSION['id'])) and (!isset($_SESSION['nome'])) and (!isset($_SESSION['email'])) ){
        unset(
            $_SESSION['id'],
            $_SESSION['nome'],
            $_SESSION['email']

        );
        header('location: ../index.php');
    }


?>