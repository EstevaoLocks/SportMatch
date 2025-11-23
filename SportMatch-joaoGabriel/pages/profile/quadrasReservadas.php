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

    <title>Seu perfil</title>
</head>
<body class="body-pgQuadrasReservadas">
    <?php
        include BASE_PATH . '/pages/includes/navbar.php';
        include BASE_PATH . '/pages/includes/navbarProfile.php';
    ?>

    <main class="main-pgQuadrasReservadas">
        <section class="sectionCalendario-pgQuadrasReservadas">
            <p>Caledario com os dias com reservas marcados</p>
        </section>

        <section class="sectionReservas-pgQuadrasReservadas">
            <p>Reservas em formato de lista</p>
        </section>
    </main>

    <?php
        include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>