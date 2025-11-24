<?php
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../../config.php';
    require_once BASE_PATH . '/sistema/classes/Usuario.php';
    require_once BASE_PATH . '/sistema/conexao.php';

    $sql = $pdo->prepare("SELECT * FROM usuario WHERE cod_usuario = :id LIMIT 1");
    $sql->bindValue(":id", $_SESSION['cod_usuario']);
    $sql->execute();

    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        die("Usuário não encontrado.");
    }

    $username = $usuario['username'] ?? '';
    $senha = $usuario['senha'] ?? '';
    $nome = $usuario['nome'] ?? '';
    $rg = $usuario['rg'] ?? '';
    $cpf = $usuario['cpf'] ?? '';
    $email = $usuario['email'] ?? '';
    $datanasc = $usuario['datanasc'] ?? '';
    $telefone = $usuario['telefone'] ?? '';
    $cep = $usuario['cep'] ?? '';
    $estado = $usuario['estado'] ?? '';
    $cidade = $usuario['cidade'] ?? '';
    $bairro = $usuario['bairro'] ?? '';
    $rua = $usuario['rua'] ?? '';
    $numero = $usuario['numero'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontes Google Fonts -->
    <!-- Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">

    <!-- Ícone Navegador -->
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/assets/img/ico/logo-azul-32.ico">

    <title>Seu perfil - Configurações</title>
</head>

<body class="body-pgProfile">
    <?php
    include BASE_PATH . '/pages/includes/navbar.php';
    include BASE_PATH . '/pages/includes/navbarProfile.php';
    ?>

    <main class="main-pgConfigProfile">
        <section class="sectionDadosCadastrais-pgConfigProfile">
            <p>Mostra dados sensiveis como nome de usuário, senha, email e etc... e dá a opção de alterar</p>
            <form action= "<?php echo BASE_URL; ?> /sistema/atualizar_dados_pessoais.php" method="POST">
    
                <!-- necessário para identificar qual registro atualizar -->
                <label>Nome:</label><br>
                <input type="text" name="nome" value="<?php echo $nome ?>" required><br><br>

                <label>Username:</label><br>
                <input type="text" name="nome" value="<?php echo $username ?>" required><br><br>
                
                <label>RG:</label><br>
                <input type="text" name="telefone" value="<?php echo $rg ?>" required><br><br>
                
                <label>CPF:</label><br>
                <input type="text" name="telefone" value="<?php echo $cpf ?>" required><br><br>
                
                <label>email:</label><br>
                <input type="text" name="telefone" value="<?php echo $email ?>" required><br><br>
                
                <label>Telefone:</label><br>
                <input type="text" name="telefone" value="<?php echo $telefone ?>" required><br><br>
                
                <label>Data de nascimento:</label><br>
                <input type="date" name="telefone" value="<?php echo $datanasc ?>" required><br><br>

                <label>Senha Atual:</label><br>
                <input type="email" name="email" placeholder="Digite sua senha" required><br><br>

                <label>Nova Senha:</label><br>
                <input type="email" name="email" placeholder="Digite uma nova senha" required><br><br>

                <button type="submit">Atualizar</button>
            </form>
        </section>

        <section class="sectionLocal-pgConfigProfile">
            <p>mosta dados do endereço cadastrado e da a opção de alterar</p>
            <form action= "<?php echo BASE_URL; ?> /sistema/atualizar_dados_local.php" method="POST">
    
                <!-- necessário para identificar qual registro atualizar -->
                <label>CEP:</label><br>
                <input type="text" name="nome" value="<?php echo $cep ?>" required><br><br>

                <label>Estado (UF):</label><br>
                <input type="text" name="nome" value="<?php echo $estado ?>" required><br><br>

                <label>Cidade:</label><br>
                <input type="email" name="email" value="<?php echo $cidade ?>" required><br><br>

                <label>Bairro:</label><br>
                <input type="email" name="email" value="<?php echo $bairro ?>" required><br><br>

                <label>Rua:</label><br>
                <input type="text" name="telefone" value="<?php echo $rua ?>" required><br><br>
                
                <label>Número:</label><br>
                <input type="text" name="telefone" value="<?php echo $numero ?>" required><br><br>
                
                <label>Senha:</label><br>
                <input type="text" name="telefone" placeholder="Digite sua senha" required><br><br>

                <button type="submit">Atualizar</button>
            </form>
        </section>

        <section class="sectionMaisOpcoes-pgConfigProfile">
            <h2>Ações da Conta</h2>
            <form method="POST">
                <button type="submit" name="btnLogOut" value="fazerLogout">Fazer Logout</button>
            </form>
            <form method="POST" action=" <?php echo BASE_PATH; ?> /sistema/exlcui_conta.php">
                <button type="submit" name="btnExcluirConta" value="excluirConta">Excluir conta</button>
            </form>

            <?php
            if (isset($_POST['btnLogOut']) && $_POST['btnLogOut'] == 'fazerLogout') {
                Usuario::fazerLogout();
            }
            ?>
        </section>
    </main>

    <?php
    include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>

</html>