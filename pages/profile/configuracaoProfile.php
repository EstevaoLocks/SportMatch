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
        <h1 class="titleUpdate-pgConfig">Seus dados</h1>
        <div class="row-pgConfigProfile">
            <section class="sectionDadosCadastrais-pgConfigProfile">
                <form action="<?php echo BASE_URL; ?> /sistema/atualizar_dados_pessoais.php" method="POST">

                    <!-- necessário para identificar qual registro atualizar -->
                    <div>
                        <label>Nome:</label>
                        <input type="text" name="nome" value="<?php echo $nome ?>" required>
                    </div>
                    <div>
                        <label>Username:</label>
                        <input type="text" name="nome" value="<?php echo $username ?>" required>
                    </div>
                    <div>
                        <label>RG:</label>
                        <input type="text" name="telefone" value="<?php echo $rg ?>" required>
                    </div>
                    <div>
                        <label>CPF:</label>
                        <input type="text" name="telefone" value="<?php echo $cpf ?>" required>
                    </div>
                    <div>
                        <label>email:</label>
                        <input type="text" name="telefone" value="<?php echo $email ?>" required>
                    </div>
                    <div>
                        <label>Telefone:</label>
                        <input type="text" name="telefone" value="<?php echo $telefone ?>" required>
                    </div>
                    <div>
                        <label>Data de nascimento:</label>
                        <input type="date" name="telefone" value="<?php echo $datanasc ?>" required>
                    </div>
                    <div>
                        <label>Senha Atual:</label>
                        <input type="email" name="email" placeholder="Digite sua senha" required>
                    </div>
                    <div>
                        <label>Nova Senha:</label>
                        <input type="email" name="email" placeholder="Digite uma nova senha" required>
                    </div>
                    <button class="btn-primary1" type="submit">Atualizar</button>
                </form>
            </section>

            <section class="sectionLocal-pgConfigProfile">
                <form action="<?php echo BASE_URL; ?> /sistema/atualizar_dados_local.php" method="POST">

                    <!-- necessário para identificar qual registro atualizar -->
                    <div>
                        <label>CEP:</label>
                        <input type="text" name="nome" value="<?php echo $cep ?>" required>
                    </div>
                    <div>
                        <label>Estado (UF):</label>
                        <input type="text" name="nome" value="<?php echo $estado ?>" required>
                    </div>
                    <div>
                        <label>Cidade:</label>
                        <input type="email" name="email" value="<?php echo $cidade ?>" required>
                    </div>
                    <div>
                        <label>Bairro:</label>
                        <input type="email" name="email" value="<?php echo $bairro ?>" required>
                    </div>
                    <div>
                        <label>Rua:</label>
                        <input type="text" name="telefone" value="<?php echo $rua ?>" required>
                    </div>
                    <div>
                        <label>Número:</label>
                        <input type="text" name="telefone" value="<?php echo $numero ?>" required>
                    </div>
                    <div>
                        <label>Senha:</label>
                        <input type="text" name="telefone" placeholder="Digite sua senha" required>
                    </div>
                    <button class="btn-primary1" type="submit">Atualizar</button>
                </form>
            </section>
        </div>


        <section class="sectionMaisOpcoes-pgConfigProfile">
        <h1 class="titleUpdate-pgConfig">Ações da Conta</h1>
            <form method="POST">
                <button class="btn-secondary1" type="submit" name="btnLogOut" value="fazerLogout">Fazer Logout</button>
            </form>
            <form method="POST" action=" <?php echo BASE_PATH; ?> /sistema/exlcui_conta.php">
                <button class="btn-secondary1" type="submit" name="btnExcluirConta" value="excluirConta">Excluir conta</button>
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