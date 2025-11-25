<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/sistema/conexao.php";

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['cod_usuario'])) {
    header("Location: " . BASE_URL . "/pages/login.php");
    exit;
}

$cod_usuario = $_SESSION['cod_usuario'];

$cep = $_POST['cep'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$senha_digitada = $_POST['senha'];

// Busca senha para confirmar
$sql = $pdo->prepare("SELECT senha FROM usuario WHERE cod_usuario = :cod_usuario LIMIT 1");
$sql->bindValue(":cod_usuario", $cod_usuario);
$sql->execute();
$dadosBanco = $sql->fetch(PDO::FETCH_ASSOC);

// CORREÇÃO: Verificação Híbrida
$senhaValida = false;
if ($senha_digitada == $dadosBanco['senha']) {
    $senhaValida = true; 
} elseif (password_verify($senha_digitada, $dadosBanco['senha'])) {
    $senhaValida = true; 
}

if ($senhaValida) {

    $sql = $pdo->prepare("
        UPDATE usuario 
        SET cep = :cep,
            estado = :estado,
            cidade = :cidade,
            bairro = :bairro,
            rua = :rua,
            numero = :numero
        WHERE cod_usuario = :cod_usuario
    ");

    $sql->bindValue(":cep", $cep);
    $sql->bindValue(":estado", $estado);
    $sql->bindValue(":cidade", $cidade);
    $sql->bindValue(":bairro", $bairro);
    $sql->bindValue(":rua", $rua);
    $sql->bindValue(":numero", $numero);
    $sql->bindValue(":cod_usuario", $cod_usuario);

    $sql->execute();

    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=Endereco+atualizado");
    exit;

} else {
    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=Senha+inválida");
    exit;
}
?>