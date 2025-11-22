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
    <title>Seu perfil</title>
</head>
<body class="body-pgProfile">
    <?php
        session_start();
        //chama arquivo que define raíz do projeto
        require_once __DIR__ . '/../../config.php';

        include 'navbar.php';
        include 'navbarProfile.php';
    ?>

    <main class="main-pgProfile">
        <section class="sectionAgenda-pgProfile">
            <h2>Últimas Reservas</h2>
            <hr>
            
        </section>

        <section class="sectionDireita-pgProfile">
            <div class="containerLocal-pgProfile">
                <p>Só para mostrar em que cidade a pessoa tá</p>

            </div>
            <div class="containerOutrasQuadras-pgProfile">
                <p>Sujestões de outras quadras</p>
            </div>
        </section>
    </main>

    <?php
        include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="assets/js/script.js"></script>
</body>
</html>