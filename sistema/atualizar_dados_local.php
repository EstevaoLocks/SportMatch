<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/sistema/conexao.php";

session_start();

$cod_usuario = $_SESSION['cod_usuario'];

$cep = $_POST['cep'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];

// --------------------------------------------------
// 1. Buscar senha do usuário no banco
// --------------------------------------------------
$sql = $pdo->prepare("
    SELECT senha 
    FROM usuario 
    WHERE cod_usuario = :cod_usuario 
    LIMIT 1
");
$sql->bindValue(":cod_usuario", $cod_usuario);
$sql->execute();

$senhaHash = $sql->fetch(PDO::FETCH_ASSOC);

if (!$senhaHash) {
    die("Erro: usuário não encontrado.");
}

// --------------------------------------------------
// 2. Verificar senha atual digitada
// --------------------------------------------------
if (password_verify($senha, $senhaHash['senha'])) {

    // Gerar hash da nova senha
    $novaSenhaHash = password_hash($nova_senha, PASSWORD_DEFAULT);

    // --------------------------------------------------
    // 3. Atualizar dados do usuário
    // --------------------------------------------------
    $sql = $pdo->prepare("
        UPDATE usuario 
        SET 

            cep = :cep,
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

    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=atualizado+com+sucesso");
    exit;

} else {

    // Senha atual incorreta
    header("Location: " . BASE_URL . "/pages/profile/configuracaoProfile.php?msg_update=senha+inválida");
    exit;
}
?>
