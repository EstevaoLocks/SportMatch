<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/sistema/conexao.php";

session_start();

if (!isset($_SESSION['cod_instituicao'])) {
    header("Location: " . BASE_URL . "/pages/login.php");
    exit;
}

$cod_instituicao = $_SESSION['cod_instituicao'];

// Recebe dados do form
$nome = $_POST['nome'];
$username = $_POST['username'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha_atual = $_POST['senha'];
$nova_senha = $_POST['nova_senha'];

// 1. Busca a senha atual no banco para verificar
$sql = $pdo->prepare("SELECT senha FROM instituicao WHERE cod_instituicao = :cod LIMIT 1"); 
$sql->bindValue(':cod', $cod_instituicao);
$sql->execute();
$dadosBanco = $sql->fetch();

// Verifica se a senha digitada bate com a do banco
// NOTA: Se no cadastro você não usou hash, use: if ($senha_atual == $dadosBanco['senha'])
// Se usou hash, mantenha password_verify. Baseado no seu arquivo de update_usuario, estou usando lógica híbrida/segura:
$senhaValida = false;
if ($senha_atual == $dadosBanco['senha']) {
    $senhaValida = true; // Senha em texto plano (legado)
} elseif (password_verify($senha_atual, $dadosBanco['senha'])) {
    $senhaValida = true; // Senha com hash (novo padrão)
}

if ($senhaValida) {
    
    // Define qual senha será salva (a nova ou mantém a antiga)
    if (!empty($nova_senha)) {
        // Cria hash da nova senha
        $senhaParaSalvar = password_hash($nova_senha, PASSWORD_DEFAULT);
    } else {
        // Mantém a senha que já estava no banco (se for update de hash) ou a atual
        // Idealmente, se a senha antiga era texto plano, deveríamos hashear ela agora
        if ($senha_atual == $dadosBanco['senha']) {
             $senhaParaSalvar = password_hash($senha_atual, PASSWORD_DEFAULT);
        } else {
             $senhaParaSalvar = $dadosBanco['senha'];
        }
    }

    // Atualiza
    $sql = $pdo->prepare("
        UPDATE instituicao 
        SET nome = :nome, 
            email = :email, 
            telefone = :telefone, 
            username = :username, 
            senha = :senha
        WHERE cod_instituicao = :cod
    ");

    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':telefone', $telefone);
    $sql->bindValue(':username', $username);
    $sql->bindValue(':senha', $senhaParaSalvar);
    $sql->bindValue(':cod', $cod_instituicao);

    if($sql->execute()) {
        header("Location: " . BASE_URL . "/pages/profile/configuracaoProfileInst.php?msg_update=Dados+atualizados+com+sucesso");
    } else {
        header("Location: " . BASE_URL . "/pages/profile/configuracaoProfileInst.php?msg_update=Erro+no+banco");
    }

} else {
    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfileInst.php?msg_update=Senha+atual+incorreta");
}
?>