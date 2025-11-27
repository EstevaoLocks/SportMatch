<?php
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../config.php';
    include_once 'conexao.php';

    // Coleta dados comuns
    $tipo = $_POST['tipo_cadastro'];
    $nome = $_POST['nome'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];
    
    // Endereço
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

    try {
        if ($tipo == 'usuario') {
            // Dados específicos de usuário
            $cpf = $_POST['cpf'];
            $rg = $_POST['rg'];
            $datanasc = $_POST['datanasc'];

            $sql = "INSERT INTO usuario (nome, username, email, senha, telefone, cpf, rg, datanasc, cep, estado, cidade, bairro, rua, numero) 
                    VALUES (:nome, :username, :email, :senha, :telefone, :cpf, :rg, :datanasc, :cep, :estado, :cidade, :bairro, :rua, :numero)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':rg', $rg);
            $stmt->bindParam(':datanasc', $datanasc);

        } else if ($tipo == 'instituicao') {
            // Instituição não tem CPF/RG/DataNasc na tabela SQL fornecida
            $sql = "INSERT INTO instituicao (nome, username, email, senha, telefone, cep, estado, cidade, bairro, rua, numero) 
                    VALUES (:nome, :username, :email, :senha, :telefone, :cep, :estado, :cidade, :bairro, :rua, :numero)";
            
            $stmt = $pdo->prepare($sql);
        }

        // Bind dos parâmetros comuns
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);

        $stmt->execute();

        $_SESSION['msg_login'] = "Cadastro realizado com sucesso! Faça login.";
        header('Location:' . BASE_URL . '/pages/conta/login.php');

    } catch(PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
?>