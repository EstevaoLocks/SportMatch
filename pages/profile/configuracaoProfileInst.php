<?php
// chama arquivo que define raíz do projeto
require_once __DIR__ . '/../../config.php';
require_once BASE_PATH . '/sistema/classes/Usuario.php'; 
require_once BASE_PATH . '/sistema/conexao.php';

// Verifica se é instituição logada
if (!isset($_SESSION['cod_instituicao'])) {
    header('Location:' . BASE_URL . '/pages/login.php');
    exit;
}

// Busca os dados da instituição
$sql = $pdo->prepare("SELECT * FROM instituicao WHERE cod_instituicao = :id LIMIT 1");
$sql->bindValue(":id", $_SESSION['cod_instituicao']);
$sql->execute();

$inst = $sql->fetch(PDO::FETCH_ASSOC);

if (!$inst) {
    die("Instituição não encontrada.");
}

// Previne erros de "undefined index" se algum campo estiver vazio no BD
$username = $inst['username'] ?? '';
$nome = $inst['nome'] ?? '';
$email = $inst['email'] ?? '';
$telefone = $inst['telefone'] ?? '';
$cep = $inst['cep'] ?? '';
$estado = $inst['estado'] ?? '';
$cidade = $inst['cidade'] ?? '';
$bairro = $inst['bairro'] ?? '';
$rua = $inst['rua'] ?? '';
$numero = $inst['numero'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/assets/img/ico/logo-azul-32.ico">

    <title>Configurações da Instituição</title>
</head>

<body class="body-pgProfile">
    <?php
    include BASE_PATH . '/pages/includes/navbar.php';
    include BASE_PATH . '/pages/includes/navbarProfile.php';
    ?>

    <main class="main-pgConfigProfile">
        <?php if (isset($_GET['msg_update'])): ?>
            <div style="background-color: #15293F; color: #45DDDD; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                <?php echo htmlspecialchars($_GET['msg_update']); ?>
            </div>
        <?php endif; ?>

        <h1 class="titleUpdate-pgConfig">Dados da Instituição</h1>
        
        <div class="row-pgConfigProfile">
            <section class="sectionDadosCadastrais-pgConfigProfile">
                <form action="<?php echo BASE_URL; ?>/sistema/atualizar_dados_inst.php" method="POST">
                    <div>
                        <label>Nome da Instituição:</label>
                        <input type="text" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
                    </div>
                    <div>
                        <label>Username (Login):</label>
                        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div>
                        <label>Email de Contato:</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div>
                        <label>Telefone:</label>
                        <input type="text" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>" required>
                    </div>
                    
                    <hr style="border-color: #2A3E52; margin: 20px 0;">
                    
                    <div>
                        <label>Senha Atual (Obrigatório):</label>
                        <input type="password" name="senha" placeholder="Digite sua senha atual" required>
                    </div>
                    <div>
                        <label>Nova Senha (Opcional):</label>
                        <input type="password" name="nova_senha" placeholder="Digite apenas se quiser mudar">
                    </div>
                    
                    <button class="btn-primary1" type="submit">Atualizar Dados</button>
                </form>
            </section>

            <section class="sectionLocal-pgConfigProfile">
                <form action="<?php echo BASE_URL; ?>/sistema/atualizar_local_inst.php" method="POST">
                    <div>
                        <label>CEP:</label>
                        <input type="text" name="cep" value="<?php echo htmlspecialchars($cep); ?>" required>
                    </div>
                    <div>
                        <label>Estado (UF):</label>
                        <input type="text" name="estado" value="<?php echo htmlspecialchars($estado); ?>" required>
                    </div>
                    <div>
                        <label>Cidade:</label>
                        <input type="text" name="cidade" value="<?php echo htmlspecialchars($cidade); ?>" required>
                    </div>
                    <div>
                        <label>Bairro:</label>
                        <input type="text" name="bairro" value="<?php echo htmlspecialchars($bairro); ?>" required>
                    </div>
                    <div>
                        <label>Rua:</label>
                        <input type="text" name="rua" value="<?php echo htmlspecialchars($rua); ?>" required>
                    </div>
                    <div>
                        <label>Número:</label>
                        <input type="text" name="numero" value="<?php echo htmlspecialchars($numero); ?>" required>
                    </div>
                    
                    <hr style="border-color: #2A3E52; margin: 20px 0;">

                    <div>
                        <label>Senha Atual (Para confirmar):</label>
                        <input type="password" name="senha" placeholder="Confirme sua senha" required>
                    </div>
                    <button class="btn-primary1" type="submit">Atualizar Endereço</button>
                </form>
            </section>
        </div>

        <section class="sectionMaisOpcoes-pgConfigProfile">
            <h1 class="titleUpdate-pgConfig">Ações da Conta</h1>
            
            <form method="POST">
                <button class="btn-secondary1" type="submit" name="btnLogOut" value="fazerLogout">Fazer Logout</button>
            </form>

            <form method="POST" action="<?php echo BASE_URL; ?>/sistema/excluir_conta_inst.php">
                 <button class="btn-secondary1" 
                    style="background-color: #cf2e2e; color: white;" 
                    type="submit" 
                    name="btnExcluirConta" 
                    onclick="return confirm('ATENÇÃO: Você tem certeza que deseja excluir a conta da INSTITUIÇÃO? Todas as quadras e reservas vinculadas serão perdidas.');">
                    Excluir conta
                </button>
            </form>

            <?php
            // Reutiliza o método de logout da classe Usuario, pois ele apenas destrói a sessão
            if (isset($_POST['btnLogOut']) && $_POST['btnLogOut'] == 'fazerLogout') {
                Usuario::fazerLogout();
            }
            ?>
        </section>
    </main>

    <?php include BASE_PATH . '/pages/includes/footer.php'; ?>
    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>