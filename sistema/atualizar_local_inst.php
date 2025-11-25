<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/sistema/conexao.php";

session_start();

if (!isset($_SESSION['cod_instituicao'])) {
    header("Location: " . BASE_URL . "/pages/login.php");
    exit;
}

$cod_instituicao = $_SESSION['cod_instituicao'];

$cep = $_POST['cep'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$senha = $_POST['senha'];

// Verifica senha antes de deixar atualizar
$sql = $pdo->prepare("SELECT senha FROM instituicao WHERE cod_instituicao = :cod LIMIT 1");
$sql->bindValue(":cod", $cod_instituicao);
$sql->execute();
$dadosBanco = $sql->fetch(PDO::FETCH_ASSOC);

$senhaValida = false;
if ($senha == $dadosBanco['senha']) {
    $senhaValida = true; 
} elseif (password_verify($senha, $dadosBanco['senha'])) {
    $senhaValida = true; 
}

if ($senhaValida) {

    $sql = $pdo->prepare("
        UPDATE instituicao 
        SET cep = :cep,
            estado = :estado,
            cidade = :cidade,
            bairro = :bairro,
            rua = :rua,
            numero = :numero
        WHERE cod_instituicao = :cod
    ");

    $sql->bindValue(":cep", $cep);
    $sql->bindValue(":estado", $estado);
    $sql->bindValue(":cidade", $cidade);
    $sql->bindValue(":bairro", $bairro);
    $sql->bindValue(":rua", $rua);
    $sql->bindValue(":numero", $numero);
    $sql->bindValue(":cod", $cod_instituicao);

    $sql->execute();

    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfileInst.php?msg_update=Endereço+atualizado");
    exit;

} else {
    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfileInst.php?msg_update=Senha+inválida");
    exit;
}
?>