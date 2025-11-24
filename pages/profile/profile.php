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
        <section class="sectionReservas-pgProfile">
            <h2 class="titleReservas-pgProfile">Últimas Reservas</h2>
            <hr class="linha-pgProfile">
            <?php
            // últimas três reservas
            require BASE_PATH . '/sistema/conexao.php';
            $sql = "SELECT  reserva.cod_reserva, reserva.duracao, reserva.valor,
            reserva.data_reserva, reserva.horario_reserva, quadra.nome_quadra, quadra.imagem, quadra.cod_quadra
            FROM reserva
            JOIN quadra
            ON reserva.cod_quadra = quadra.cod_quadra
            WHERE reserva.cod_usuario = :cod_usuario
            ORDER BY reserva.data_reserva DESC LIMIT 3";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cod_usuario', $_SESSION['cod_usuario']);
            $stmt->execute();
            while ($reserva = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="cardReserva">
                    <div class="imgcardReserva">
                        <img src="<?php echo BASE_URL; ?>/assets/img/<?php echo $reserva['imagem']; ?>" alt="Imagem da quadra <?php echo $reserva['nome_quadra']; ?>">
                    </div>
                    <div class="bodycardReserva">
                        <div class="containerCima-Reservas">
                            <p class="codReserva">Código da reserva: <?php echo $reserva['cod_reserva']; ?></p>
                            <a href="<?php echo BASE_URL; ?> /pages/produto.php?id=<?php echo $reserva['cod_quadra']; ?>"><h3 class="nomeQuadra-Reservas"><?php echo $reserva['nome_quadra']; ?></h3></a>
                        </div>
                        <div class="containerDetalhes-reserva">
                            <div class="dFlex-cardReserva">
                                <div>
                                    <p class="labelCardReserva">Data: </p>
                                    <p class="contentData-CardReserva"><?php echo $reserva['data_reserva']; ?></p>
                                </div>
                                <div>
                                    <p class="labelCardReserva">Horário: </p>
                                    <p class="contentHora-CardReserva"><?php echo $reserva['horario_reserva']; ?></p>
                                </div>
                            </div>
                            <p class="labelCardReserva">Duração reservada: </p>
                            <p class="contentDuracao-CardReserva"><?php echo $reserva['duracao']; ?>h</p>
                            <p class="labelCardReserva">Valor total: </p>
                            <p class="contentValor-CardReserva">R$ <?php echo $reserva['valor']; ?></p>
                        </div>
                    </div>
                </div>
                <hr class="linha-pgProfile">
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
                <h4 class="titleQntReservas">Total de reservas: </h4>
                <p class="qntTotalReservas"><?php echo $reserva['quantidade_reservas']; ?></p>

                <?php
                // quantidade de reservas já executadas
                $sql = "SELECT COUNT(*) AS reservas_realizadas
                FROM reserva
                WHERE cod_usuario = :cod_usuario AND data_reserva < CURDATE()";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':cod_usuario', $_SESSION['cod_usuario']);
                $stmt->execute();
                $reserva = $stmt->fetch(PDO::FETCH_ASSOC)
                ?>
                <p class="titleQntReservas">Reservas efetuadas: </p>
                <p class="qntReservasEfetuadas"><?php echo $reserva['reservas_realizadas']; ?></p>

                <?php
                // quantidade de reservas agendadas
                $sql = "SELECT COUNT(*) AS reservas_agendadas
                FROM reserva
                WHERE cod_usuario = :cod_usuario AND data_reserva > CURDATE()";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':cod_usuario', $_SESSION['cod_usuario']);
                $stmt->execute();
                $reserva = $stmt->fetch(PDO::FETCH_ASSOC)
                ?>
                <p class="titleQntReservas">Reservas agendadas: </p>
                <p class="qntReservasAgendadas"><?php echo $reserva['reservas_agendadas']; ?></p>
            </div>
            <div class="containerOutrasQuadras-pgProfile">
                <p>Sujestões de outras quadras</p>
                <?php
                require_once BASE_PATH . '/sistema/classes/Endereco.php';
                // (new Endereco)->calcularDistancia();
                ?>
            </div>
        </section>
    </main>

    <?php
    include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>

</html>