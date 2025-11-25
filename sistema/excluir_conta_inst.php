<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/sistema/conexao.php";

session_start();

if (!isset($_SESSION['cod_instituicao'])) {
    header("Location: " . BASE_URL . "/pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cod_instituicao = $_SESSION['cod_instituicao'];

    try {
        $pdo->beginTransaction();

        // 1. Deletar (ou desvincular) reservas das quadras dessa instituição?
        // Isso é complexo. O ideal é deletar as quadras primeiro.
        // Se o seu banco tiver FK com ON DELETE CASCADE, deletar a instituição resolve tudo.
        // Caso contrário, precisamos limpar manualmente:
        
        // Exemplo manual (se não tiver cascade):
        // $pdo->query("DELETE FROM reserva WHERE cod_quadra IN (SELECT cod_quadra FROM quadra WHERE cod_instituicao = $cod_instituicao)");
        // $pdo->query("DELETE FROM quadra_mod WHERE cod_quadra IN (SELECT cod_quadra FROM quadra WHERE cod_instituicao = $cod_instituicao)");
        // $pdo->query("DELETE FROM quadra WHERE cod_instituicao = $cod_instituicao");

        // Deleta a instituição
        $sql = $pdo->prepare("DELETE FROM instituicao WHERE cod_instituicao = :cod");
        $sql->bindValue(':cod', $cod_instituicao);
        $sql->execute();

        $pdo->commit();

        // Destrói a sessão e manda para home
        session_destroy();
        header("Location: " . BASE_URL . "/index.php");
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        // Em caso de erro (provavelmente chave estrangeira de quadras/reservas)
        header("Location: " . BASE_URL . "/pages/profile/configuracaoProfileInst.php?msg_update=Erro+ao+excluir:+existem+quadras+vinculadas");
    }
} else {
    header("Location: " . BASE_URL . "/index.php");
}
?>