<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/sistema/conexao.php";


$cod_usuario = $_SESSION['cod_usuario'];
$username = $_POST['username'];
$senha = $_POST['senha'];
$nova_senha = $_POST['nova_senha'];
$nome = $_POST['nome'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$datanasc = $_POST['datanasc'];
$telefone = $_POST['telefone'];

$sql = $pdo->prepare("
    SELECT senha FROM usuario WHERE cod_usuario = :cod_usuario LIMIT 1
"); 

$sql->execute();

$senhaHash = $sql->fetch();

if (password_verify($senha, $senhaHash[0])) {
    
    $sql = $pdo->prepare("
    UPDATE usuario 
    SET nome = :nome, email = :email, telefone = :telefone, cidade = :cidade, username = :username, senha = :senha, rg = :rg, cpf = :cpf, datanasc = :datanasc
    WHERE cod_usuario = :cod_usuario
    ");

    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':cidade', $cidade);
    $sql->bindValue(':cod_usuario', $cod_usuario);
    $sql->bindValue(':username', $username);
    $sql->bindValue(':senha', $nova_senha);
    $sql->bindValue(':rg', $rg);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':datanasc', $datanasc);
    
    $sql->bindValue(":cod_usuario", $cod_usuario);

    $sql->execute();
    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=atualizado+com+sucesso");

} else {

    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=senha+inválida");

}



?>