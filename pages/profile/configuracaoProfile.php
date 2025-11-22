<?php
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../../config.php';
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
    <link rel="icon" type="image/x-icon" href="assets/img/ico/logo-azul-32.ico">

    <title>Seu perfil - Configurações</title>
</head>
<body class="body-pgProfile">
    <?php

        session_start();
        include BASE_PATH . '/pages/includes/navbar.php';
        include BASE_PATH . '/pages/includes/navbarProfile.php';
    ?>

    <main class="main-pgConfigProfile">
        <section class="sectionDadosCadastrais-pgConfigProfile">
            <p>Mostra dados sensiveis como nome de usuário, senha, email e etc... e dá a opção de alterar</p>
        </section>

        <section class="sectionLocal-pgConfigProfile">
            <p>mosta dados do endereço cadastrado e da a opção de alterar</p>
        </section>

        <section class="sectionMaisOpcoes-pgConfigProfile">
            <h2>Ações da Conta</h2>
            <form method="POST">
                <button type="submit" name="btnLogOut" value="fazerLogout">Fazer Logout</button>
            </form>

            <?php 
                if (isset($_POST['btnLogOut']) && $_POST['btnLogOut'] == 'fazerLogout') {
                    Usuario::fazerLogout();
                    echo "até aqui funciona";
                    exit;
                }

                // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //     if (isset($_POST['btnLogOut']) && $_POST['btnLogOut'] === 'fazerLogout') {
                //         // ação
                //         session_start();
                //         session_destroy();
                //         header("Location: login.php");
                //         exit;
                //     }
                // }
            ?>
        </section>
    </main>

    <?php
        include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>