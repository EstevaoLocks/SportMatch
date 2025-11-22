<?php
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../config.php';

    class Usuario
    {
        // Métodos

        // criar conta
        public static function criarContaUsuario(
            // Coleta dados comuns
            $nome,
            $username,
            $email,
            $senha,
            $telefone,

            // Dados específicos de usuário
            $cpf,
            $rg,
            $datanasc,

            // Endereço
            $cep,
            $estado,
            $cidade,
            $bairro,
            $rua,
            $numero) {

            session_start();
            include_once 'conexao.php';

            try {

                $sql = "INSERT INTO usuario (nome, username, email, senha, telefone, cpf, rg, datanasc, cep, estado, cidade, bairro, rua, numero) 
                        VALUES (:nome, :username, :email, :senha, :telefone, :cpf, :rg, :datanasc, :cep, :estado, :cidade, :bairro, :rua, :numero)";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':rg', $rg);
                $stmt->bindParam(':datanasc', $datanasc);

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
                header('Location: ../login.php');
            } catch (PDOException $e) {
                echo "Erro ao cadastrar: " . $e->getMessage();
            }
        } // end method criarContaUsuario

        // criar conta
        public static function criarContaInstituicao(
            // Coleta dados comuns
            $nome,
            $username,
            $email,
            $senha,
            $telefone,

            // Endereço
            $cep,
            $estado,
            $cidade,
            $bairro,
            $rua,
            $numero) {
            
            session_start();
            include_once 'conexao.php';

            try {
                // Instituição não tem CPF/RG/DataNasc na tabela SQL fornecida
                $sql = "INSERT INTO instituicao (nome, username, email, senha, telefone, cep, estado, cidade, bairro, rua, numero) 
                            VALUES (:nome, :username, :email, :senha, :telefone, :cep, :estado, :cidade, :bairro, :rua, :numero)";
        
                $stmt = $pdo->prepare($sql);
        
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
                header('Location: ../login.php');
            } catch(PDOException $e) {
                echo "Erro ao cadastrar: " . $e->getMessage();
            }
        }// end method criarContaAdm

        // login
        public static function fazerLogin($email, $senha) {
            session_start();
            include_once 'conexao.php';

            $consulta = "SELECT * FROM usuarios WHERE email = :email";

            $stmt = $pdo->prepare($consulta);

            // Vincula os parâmetros
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);

            // Executa a consulta
            $stmt->execute();

            // Obtém o número de registros encontrados
            $registros = $stmt->rowCount();

            // Obtém o resultado
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($resultado);

            if ($registros == 0) {
                //echo "VOCÊ NÃO TEM PERMISSÃO";
                return 'nao-encontrado';
            } else {
                if (password_verify($senhaDigitada, $resultado['senha'])) {
                    $_SESSION['id'] = $resultado['id'];
                    $_SESSION['nome'] = $resultado['nome'];
                    $_SESSION['email'] = $resultado['email'];
                    header('Location: ../profile.php');

                } else {
                    return "senha-incorreta";
                }
            }
        } // end fazerLogin

        // logout
        public static function fazerLogout() {
            session_start();
            session_destroy();

            header('Location: index.php');
        }// end method fazerLogout
    }// end Class
?>