<?php
//chama arquivo que define raíz do projeto
require_once __DIR__ . '/../../config.php';
require_once BASE_PATH . '/sistema/conexao.php';

// Query de Quadras
$sql = "SELECT DISTINCT *
            FROM quadra
            JOIN favoritos 
            ON quadra.cod_quadra = favoritos.cod_quadra
            WHERE favoritos.cod_usuario = :cod_usuario";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':cod_usuario', $_SESSION['cod_usuario']);
$stmt->execute();
$quadras = $stmt->fetchAll();

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

    <title>Seus favoritos</title>
</head>

<body class="body-pgQuadrasReservadas">
    <?php
    include BASE_PATH . '/pages/includes/navbar.php';
    include BASE_PATH . '/pages/includes/navbarProfile.php';
    ?>

    <main class="main-pgQuadrasReservadas">

        <section class="sectionReservas-pgQuadrasReservadas">
            <h1>Suas reservas</h1>
            <div class="quadrasContainer">

                <?php if (count($quadras) > 0): ?>
                    <?php foreach ($quadras as $quadra): ?>
                        <?php
                        // Lógica de Imagem: Verifica se existe imagem cadastrada no banco
                        if (!empty($quadra['imagem'])) {
                            $imgSrc = BASE_URL . '/assets/img/quadras/' . $quadra['imagem'];
                        } else {
                            // Fallback para placeholders se não tiver imagem customizada
                            $imgSrc = BASE_URL . '/assets/img/quadra-fut.png';
                            $nomeMod = strtolower($quadra['nome_mod']);

                            if (strpos($nomeMod, 'basquete') !== false) {
                                $imgSrc = BASE_URL . '/assets/img/quadraBaquete 1.png';
                            } elseif (strpos($nomeMod, 'vôlei') !== false || strpos($nomeMod, 'volei') !== false) {
                                $imgSrc = BASE_URL . '/assets/img/quadra-de-volei4 1.png';
                            } elseif (strpos($nomeMod, 'tênis') !== false) {
                                $imgSrc = BASE_URL . '/assets/img/quadraTenis.png';
                            }
                        }
                        ?>

                        <div class="cardQuadra">
                            <div class="cardImageContainer">
                                <!-- onerror: garante que se a imagem quebrar, mostra um padrão -->
                                <img src="<?php echo $imgSrc; ?>" alt="Foto da <?php echo $quadra['nome_quadra']; ?>" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/quadra-fut.png'">
                            </div>

                            <div class="infoQuadra">
                                <h3 class="tituloQuadra"><?php echo htmlspecialchars($quadra['nome_quadra']); ?></h3>

                                <p class="localQuadra">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo htmlspecialchars($quadra['rua'] . ', ' . $quadra['numero']); ?>
                                </p>
                                <p class="localQuadraDetalhe">
                                    <?php echo htmlspecialchars($quadra['bairro'] . ' - ' . $quadra['cidade'] . '/' . $quadra['estado']); ?>
                                </p>

                                <div class="containerStars">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>

                                <div class="detalhesQuadra">
                                    <p><span>Esporte:</span> <?php echo htmlspecialchars($quadra['nome_mod']); ?></p>
                                    <p><span>Tamanho:</span> <?php echo htmlspecialchars($quadra['tamanho']); ?></p>
                                    <p><span>Piso:</span> <?php echo htmlspecialchars($quadra['composicao']); ?></p>
                                </div>

                                <p class="precoQuadra">R$ <?php echo number_format($quadra['valor_hora'], 2, ',', '.'); ?>/h</p>

                                <a href="detalhes_quadra.php?id=<?php echo $quadra['cod_quadra']; ?>" class="btnReservar">Veja mais</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="mensagemSemQuadra">
                        <p>Você ainda não tem nenhuma nenhuma quadra favoritada</p>
                    </div>
                <?php endif; ?>

            </div>
        </section>
    </main>

    <?php
    include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>

</html>