<?php
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../config.php';
    unset(
        $_SESSION['id'],
        $_SESSION['nome'],
        $_SESSION['email']
    );
    header("Location: ../login.php");
    exit;
?>