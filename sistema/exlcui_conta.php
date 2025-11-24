<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/sistema/conexao.php";

session_start();

$cod_usuario = $_SESSION['cod_usuario'];

// -----------------------------------------
// Excluir usuário logado
// -----------------------------------------
$sql = $pdo->prepare("
    DELETE FROM usuario 
    WHERE cod_usuario = :cod_usuario
");

$sql->bindValue(":cod_usuario", $cod_usuario, PDO::PARAM_INT);

if ($sql->execute()) {

    // destruir sessão
    session_destroy();

    // redirecionar ao logout ou página inicial
    header("Location: " . BASE_URL . "/index.php?msg=conta+excluída+com+sucesso");
    exit;

} else {
    
    // redirecionar ao logout ou página inicial
    header("Location: " . BASE_URL . "/index.php?msg=falha+ao+excluir");
}