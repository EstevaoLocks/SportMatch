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
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Ícone Navegador -->
    <link rel="icon" type="image/x-icon" href="assets/img/ico/logo-azul-32.ico">

    <title>Seu perfil - Configurações</title>
</head>
<body class="body-pgProfile">
    <?php
        $is_profilePg = true;

        session_start();
        include 'navbar.php';
        include 'navbarProfile.php';
    ?>

    <main class="main-pgConfigProfile">
        <section class="sectionDadosCadastrais-pgConfigProfile">
            <p>Mostra dados sensiveis como nome de usuário, senha, email e etc... e dá a opção de alterar</p>
        </section>

        <section class="sectionLocal-pgConfigProfile">
            <p>mosta dados do endereço cadastrado e da a opção de alterar</p>
        </section>
    </main>

    <?php include 'footer.php'?>

    <script src="assets/js/script.js"></script>
</body>
</html>