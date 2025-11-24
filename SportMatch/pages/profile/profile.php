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
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/assets/img/ico/logo-azul-32.ico">
    <title>Seu perfil</title>
</head>

<body class="body-pgProfile">
    <?php
    include BASE_PATH . '/pages/includes/navbar.php';
    include BASE_PATH . '/pages/includes/navbarProfile.php';
    ?>

    <main class="main-pgProfile">
        <section class="sectionAgenda-pgProfile">
            <h2>Últimas Reservas</h2>
            <hr>
            <?php
            // últimas três reservas
            require BASE_PATH . '/sistema/conexao.php';
            $sql = "SELECT  reserva.cod_reserva, reserva.duracao, reserva.valor,
            reserva.data_reserva, reserva.horario_reserva, quadra.nome_quadra
            FROM reserva
            JOIN quadra
            ON reserva.cod_quadra = quadra.cod_quadra
            WHERE reserva.cod_usuario = :cod_usuario
            ORDER BY reserva.data_reserva DESC LIMIT 3";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cod_usuario', $_SESSION['cod_usuario']);
            $stmt->execute();
            while ($reserva = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <h3><?php echo $reserva['nome_quadra']; ?></h3>
                <p>Código da reserva: <?php echo $reserva['cod_reserva']; ?></p>
                <p>Duração reservada: <?php echo $reserva['duracao']; ?>h</p>
                <p>Valor total: R$<?php echo $reserva['valor']; ?></p>
                <p>Data: <?php echo $reserva['data_reserva']; ?></p>
                <p>Horário: <?php echo $reserva['horario_reserva']; ?></p>
                <hr>
            <?php endwhile ?>
        </section>

        <section class="sectionDireita-pgProfile">
            <div class="containerLocal-pgProfile">
                <?php
                // quantidade de reservas
                require BASE_PATH . '/sistema/conexao.php';
                $sql = "SELECT COUNT(*) AS quantidade_reservas
                FROM reserva
                WHERE cod_usuario = :cod_usuario";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':cod_usuario', $_SESSION['cod_usuario']);
                $stmt->execute();
                $reserva = $stmt->fetch(PDO::FETCH_ASSOC)
                ?>
                <h4>Total de quadras reservadas:</h4>
                <p><?php echo $reserva['quantidade_reservas']; ?></p>

            </div>
            <div class="containerOutrasQuadras-pgProfile">
                <p>Sujestões de outras quadras</p>
            </div>
        </section>
    </main>

    <?php
    include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>

</html>