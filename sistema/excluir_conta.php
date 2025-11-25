<?php
    // Chama arquivos essenciais
    require_once __DIR__ . '/../config.php';
    require_once BASE_PATH . '/sistema/conexao.php';
    require_once BASE_PATH . '/sistema/classes/Usuario.php';

    // 1. Verifica se o usuário está logado
    if (!isset($_SESSION['cod_usuario'])) {
        header('Location:' . BASE_URL . '/pages/conta/login.php');
        exit;
    }

    // 2. Verifica se o formulário de exclusão foi submetido
    if (isset($_POST['btnExcluirConta']) && $_POST['btnExcluirConta'] === 'excluirConta') {

        $cod_usuario = $_SESSION['cod_usuario'];

        // Implementação de segurança: Idealmente, o usuário deveria digitar a senha
        // aqui para confirmar a ação. Por simplicidade, o código abaixo usa apenas o ID da sessão.
        // Você deve adicionar a lógica de verificação de senha.

        try {
            // Inicia uma transação para garantir que todas as exclusões sejam realizadas
            // ou nenhuma em caso de erro (atomicidade).
            $pdo->beginTransaction();

            // 4. Excluir registros dependentes (Chaves Estrangeiras)
            
            // Exclui Favoritos relacionados ao usuário
            $sql_fav = $pdo->prepare("DELETE FROM favoritos WHERE cod_usuario = :id");
            $sql_fav->bindValue(":id", $cod_usuario, PDO::PARAM_INT);
            $sql_fav->execute();

            // Exclui Reservas relacionadas ao usuário
            $sql_res = $pdo->prepare("DELETE FROM reserva WHERE cod_usuario = :id");
            $sql_res->bindValue(":id", $cod_usuario, PDO::PARAM_INT);
            $sql_res->execute();

            // 5. Excluir o registro do usuário na tabela 'usuario'
            $sql_user = $pdo->prepare("DELETE FROM usuario WHERE cod_usuario = :id");
            $sql_user->bindValue(":id", $cod_usuario, PDO::PARAM_INT);
            $sql_user->execute();

            // Se tudo deu certo, confirma as alterações no banco de dados
            $pdo->commit();

            // 6. Destruir a sessão e redirecionar
            Usuario::fazerLogout(); // Assumindo que esta função destrói a sessão e redireciona

        } catch (PDOException $e) {
            // Em caso de erro, desfaz as alterações
            $pdo->rollBack();
            // Em um sistema real, você registraria o erro e mostraria uma mensagem amigável
            // die("Erro ao excluir a conta: " . $e->getMessage());
            header('Location:' . BASE_URL . '/pages/conta/configuracaoProfile.php?erro=db'); // Redireciona com erro
            exit;
        }

    } else {
        // Se o acesso foi direto e não via POST, redireciona
        header('Location:' . BASE_URL . '/pages/conta/configuracaoProfile.php');
        exit;
    }
?>