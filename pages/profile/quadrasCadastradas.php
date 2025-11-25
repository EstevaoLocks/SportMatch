<?php
//chama arquivo que define raíz do projeto
require_once __DIR__ . '/../../config.php';

if (!isset($_SESSION['cod_instituicao']) || !isset($_SESSION['nome']) || !isset($_SESSION['email'])){
    header('Location:' . BASE_URL . '/pages/conta/login.php');
}
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

    <title>Suas Reservas</title>
</head>

<body class="body-pgQuadrasReservadas">
    <?php
    include BASE_PATH . '/pages/includes/navbar.php';
    include BASE_PATH . '/pages/includes/navbarProfileInstituicao.php';
    ?>

    <main class="main-pgQuadrasReservadas">

    <section class="sectionReservas-pgReservas">
            <h2 class="titleReservas-pgProfile">Suas Quadras Cadastradas</h2>
            <hr class="linha-pgProfile">
            <?php
            // últimas três reservas
            require BASE_PATH . '/sistema/conexao.php';
            $sql = "SELECT  quadra.cod_quadra, quadra.tamanho, quadra.valor_hora,
            quadra.cidade, quadra.cep, quadra.nome_quadra, quadra.imagem
            FROM quadra
            JOIN instituicao
            ON quadra.cod_instituicao = instituicao.cod_instituicao
            WHERE instituicao.cod_instituicao = :cod_instituicao
            ORDER BY quadra.nome_quadra DESC LIMIT 3";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cod_instituicao', $_SESSION['cod_instituicao']);
            $stmt->execute();
            while ($quadra = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="cardReserva">
                    <div class="imgcardReserva">
                        <img src="<?php echo BASE_URL; ?>/assets/img/<?php echo $quadra['imagem']; ?>" alt="Imagem da quadra <?php echo $quadra['nome_quadra']; ?>">
                    </div>
                    <div class="bodycardReserva">
                        <div class="containerCima-Reservas">
                            <p class="codReserva">Código da quadra: <?php echo $quadra['cod_quadra']; ?></p>
                            <a href="<?php echo BASE_URL; ?> /pages/produto.php?id=<?php echo $quadra['cod_quadra']; ?>">
                                <h3 class="nomeQuadra-Reservas"><?php echo $quadra['nome_quadra']; ?></h3>
                            </a>
                        </div>
                        <div class="containerDetalhes-reserva">
                            <div class="dFlex-cardReserva">
                                <div>
                                    <p class="labelCardReserva">Cidade: </p>
                                    <p class="contentData-CardReserva"><?php echo $quadra['cidade']; ?></p>
                                </div>
                                <div>
                                    <p class="labelCardReserva">Cep: </p>
                                    <p class="contentHora-CardReserva"><?php echo $quadra['cep']; ?></p>
                                </div>
                            </div>
                            <p class="labelCardReserva">Tamanho quadra: </p>
                            <p class="contentDuracao-CardReserva"><?php echo $quadra['tamanho']; ?>h</p>
                            <p class="labelCardReserva">Valor/h: </p>
                            <p class="contentValor-CardReserva">R$ <?php echo $quadra['valor_hora']; ?></p>
                        </div>
                    </div>
                </div>
                <hr class="linha-pgProfile">
            <?php endwhile ?>
        </section>
    </main>

    <?php
    include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>

</html>