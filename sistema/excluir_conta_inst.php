<?php

    require_once __DIR__ . '/../config.php';
    require_once BASE_PATH . '/sistema/conexao.php';
    require_once BASE_PATH . '/sistema/classes/Usuario.php';

    if (session_status() === PHP_SESSION_NONE) session_start();

    // 1. Verifica se é INSTITUIÇÃO (cod_instituicao)
    if (!isset($_SESSION['cod_instituicao'])) {
        // Se não estiver logado, redireciona para o login correto
        header('Location:' . BASE_URL . '/pages/login.php');
        exit;
    }

    // 2. Verifica o botão
    if (isset($_POST['btnExcluirConta'])) {

        $cod_instituicao = $_SESSION['cod_instituicao'];

        try {
            $pdo->beginTransaction();

            // --- LÓGICA DE EXCLUSÃO DA EMPRESA ---
            
            // Passo A: Apagar RESERVAS das quadras dessa instituição
            // (Deleta reservas onde a quadra pertence à instituição logada)
            $sql_res = $pdo->prepare("
                DELETE FROM reserva 
                WHERE cod_quadra IN (SELECT cod_quadra FROM quadra WHERE cod_instituicao = :id)
            ");
            $sql_res->bindValue(":id", $cod_instituicao, PDO::PARAM_INT);
            $sql_res->execute();

            // Passo B: Apagar VÍNCULOS DE MODALIDADE (quadra_mod)
            $sql_mod = $pdo->prepare("
                DELETE FROM quadra_mod 
                WHERE cod_quadra IN (SELECT cod_quadra FROM quadra WHERE cod_instituicao = :id)
            ");
            $sql_mod->bindValue(":id", $cod_instituicao, PDO::PARAM_INT);
            $sql_mod->execute();

            // Passo C: Apagar as QUADRAS
            $sql_quadra = $pdo->prepare("DELETE FROM quadra WHERE cod_instituicao = :id");
            $sql_quadra->bindValue(":id", $cod_instituicao, PDO::PARAM_INT);
            $sql_quadra->execute();

            // Passo D: Apagar a INSTITUIÇÃO
            $sql_inst = $pdo->prepare("DELETE FROM instituicao WHERE cod_instituicao = :id");
            $sql_inst->bindValue(":id", $cod_instituicao, PDO::PARAM_INT);
            $sql_inst->execute();

            $pdo->commit();

            // 3. Logout e Tchau
            Usuario::fazerLogout(); 

        } catch (PDOException $e) {
            $pdo->rollBack();
            // Redireciona de volta com erro
            header('Location:' . BASE_URL . '/pages/profile/configuracaoProfileInst.php?msg_update=Erro+ao+excluir+conta');
            exit;
        }

    } else {
        header('Location:' . BASE_URL . '/pages/profile/configuracaoProfileInst.php');
        exit;
    }
?>