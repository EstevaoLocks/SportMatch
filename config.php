<?php 

    // Descobre caminho da URL
    $root = dirname($_SERVER['SCRIPT_NAME']);
    define("BASE_URL", $root);
    // Descobre caminho das pastas
    define('BASE_PATH', __DIR__);

?>