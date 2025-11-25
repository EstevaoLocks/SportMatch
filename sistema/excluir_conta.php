<?php
// Chama arquivos essenciais
    require_once __DIR__ . '/../config.php';
    require_once BASE_PATH . '/sistema/conexao.php';
    require_once BASE_PATH . '/sistema/classes/Usuario.php';

    // Inicia sessão se não estiver iniciada
    if (session_status() === PHP_SESSION_NONE) session_start();

    // 1. Verifica se o usuário está logado
    if (!isset($_SESSION['cod_usuario'])) {
        // CORREÇÃO: Ajuste este caminho se seu login estiver em outro lugar
        header('Location:' . BASE_URL . '/pages/login.php');
        exit;
    }

    // 2. Verifica se o formulário de exclusão foi submetido
    // CORREÇÃO: Removemos a checagem rigida do 'value', checamos apenas se o botão foi clicado
    if (isset($_POST['btnExcluirConta'])) {

        $cod_usuario = $_SESSION['cod_usuario'];

        try {
            $pdo->beginTransaction();

            // 3. Excluir registros dependentes
            
            // Exclui Favoritos
            $sql_fav = $pdo->prepare("DELETE FROM favoritos WHERE cod_usuario = :id");
            $sql_fav->bindValue(":id", $cod_usuario, PDO::PARAM_INT);
            $sql_fav->execute();

            // Exclui Reservas
            $sql_res = $pdo->prepare("DELETE FROM reserva WHERE cod_usuario = :id");
            $sql_res->bindValue(":id", $cod_usuario, PDO::PARAM_INT);
            $sql_res->execute();

            // 4. Excluir o usuário
            $sql_user = $pdo->prepare("DELETE FROM usuario WHERE cod_usuario = :id");
            $sql_user->bindValue(":id", $cod_usuario, PDO::PARAM_INT);
            $sql_user->execute();

            $pdo->commit();

            // 5. Destruir sessão e redirecionar
            Usuario::fazerLogout(); 

        } catch (PDOException $e) {
            $pdo->rollBack();
            // CORREÇÃO: Caminho alterado de 'conta' para 'profile'
            header('Location:' . BASE_URL . '/pages/profile/configuracaoProfile.php?msg_erro=Erro+ao+excluir+conta');
            exit;
        }

    } else {
        // CORREÇÃO: Caminho alterado de 'conta' para 'profile'
        header('Location:' . BASE_URL . '/pages/profile/configuracaoProfile.php');
        exit;
    }
?>