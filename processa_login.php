<?php
    // Arquivo: processa_login.php
    session_start();    
    include_once 'conexao.php';
    
    // Recebe dados do formulário
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    
    // 1. VERIFICAÇÃO DE ADMINISTRADOR (Fixo para testes)
    if($email == 'admin@sportmatch.com' && $senha == 'admin123'){
        $_SESSION['id'] = 0;
        $_SESSION['nome'] = 'Administrador';
        $_SESSION['email'] = $email;
        $_SESSION['tipo_usuario'] = 'admin';
        header('Location: dashboard_admin.php'); // Ou index.php se não tiver dash de admin
        exit();
    }

    // 2. VERIFICAÇÃO DE USUÁRIO COMUM
    $queryUser = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
    $stmtUser = $pdo->prepare($queryUser);
    $stmtUser->bindParam(':email', $email);
    $stmtUser->bindParam(':senha', $senha);
    $stmtUser->execute();

    if($stmtUser->rowCount() == 1){
        $resultado = $stmtUser->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $resultado['cod_usuario'];
        $_SESSION['nome'] = $resultado['nome'];
        $_SESSION['email'] = $resultado['email'];
        $_SESSION['tipo_usuario'] = 'usuario'; 
        header('Location: minhas_reservas.php'); // Manda para o painel do usuário
        exit();
    }

    // 3. VERIFICAÇÃO DE INSTITUIÇÃO
    $queryInst = "SELECT * FROM instituicao WHERE email = :email AND senha = :senha";
    $stmtInst = $pdo->prepare($queryInst);
    $stmtInst->bindParam(':email', $email);
    $stmtInst->bindParam(':senha', $senha);
    $stmtInst->execute();

    if($stmtInst->rowCount() == 1){
        $resultado = $stmtInst->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $resultado['cod_instituicao'];
        $_SESSION['nome'] = $resultado['nome'];
        $_SESSION['email'] = $resultado['email'];
        $_SESSION['tipo_usuario'] = 'instituicao';
        header('Location: dashboard_instituicao.php'); // Manda para o painel da instituição
        exit();
    }

    // SE NENHUM DEU CERTO
    $_SESSION['msg_login'] = "Email ou senha incorretos!";
    header('Location: login.php');
?>