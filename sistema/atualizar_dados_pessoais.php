<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/sistema/conexao.php";

// CORREÇÃO 1: Iniciar a sessão
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['cod_usuario'])) {
    header("Location: " . BASE_URL . "/pages/login.php");
    exit;
}

$cod_usuario = $_SESSION['cod_usuario'];

// Recebe dados
$username = $_POST['username'];
$nome = $_POST['nome'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$datanasc = $_POST['datanasc'];
$telefone = $_POST['telefone'];

// Senhas
$senha_digitada = $_POST['senha'];
$nova_senha = $_POST['nova_senha'];

// Busca senha atual no banco
$sql = $pdo->prepare("SELECT senha FROM usuario WHERE cod_usuario = :cod_usuario LIMIT 1"); 
$sql->bindValue(':cod_usuario', $cod_usuario);
$sql->execute();
$dadosBanco = $sql->fetch(PDO::FETCH_ASSOC);

// CORREÇÃO 2: Verificação Híbrida (Texto Puro ou Hash)
$senhaValida = false;
if ($senha_digitada == $dadosBanco['senha']) {
    $senhaValida = true; 
} elseif (password_verify($senha_digitada, $dadosBanco['senha'])) {
    $senhaValida = true; 
}

if ($senhaValida) {
    
    // CORREÇÃO 3: Lógica inteligente para nova senha
    if (!empty($nova_senha)) {
        $senhaParaSalvar = password_hash($nova_senha, PASSWORD_DEFAULT);
    } else {
        // Se a senha antiga era texto puro, aproveita para atualizar para hash agora
        if ($senha_digitada == $dadosBanco['senha']) {
             $senhaParaSalvar = password_hash($senha_digitada, PASSWORD_DEFAULT);
        } else {
             $senhaParaSalvar = $dadosBanco['senha'];
        }
    }

    // CORREÇÃO 4: Removido o campo 'cidade' desta query, pois ele pertence ao outro arquivo
    $sql = $pdo->prepare("
        UPDATE usuario 
        SET nome = :nome, 
            email = :email, 
            telefone = :telefone, 
            username = :username, 
            senha = :senha, 
            rg = :rg, 
            cpf = :cpf, 
            datanasc = :datanasc
        WHERE cod_usuario = :cod_usuario
    ");

    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':username', $username);
    $sql->bindValue(':senha', $senhaParaSalvar);
    $sql->bindValue(':rg', $rg);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':datanasc', $datanasc);
    $sql->bindValue(":cod_usuario", $cod_usuario);

    if($sql->execute()) {
        header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=Dados+pessoais+atualizados");
    } else {
        header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=Erro+no+banco");
    }

} else {
    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=Senha+atual+incorreta");
}
?>