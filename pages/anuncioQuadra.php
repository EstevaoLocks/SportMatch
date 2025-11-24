<?php 
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../config.php';
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

    <title>Anúncio de Quadra</title>
</head>
<body>
    <?php
        include BASE_PATH . '/pages/includes/navbar.php';
    ?>

    <!-- Conteúdo página anúncio quadra -->
    <main class="mainEstreita">
        <!-- Section 1 - Conteúdo Principal anúncio -->
        <div class="conteudoAnuncio">
            <section class="conteudoPrincipal-pgAnuncio">
                <div class="containerImagensAnuncio">
                    <!--<p>Imagins do anúncio</p>-->
                       <img src="<?php echo BASE_URL; ?>/assets\img\Quadra-de-Futsal-profissional 1.png" alt="Imagem da quadra">
                </div>
                <div class="containerInfo">
                    <div class="titleAnuncio-pgAnuncio">
                        <p>Nome do anúncio da quadra</p>
                    </div>
                    <div class="caracteristicasAnuncio-pgAnuncio">
                        <p>Características do anúncio da quadra</p>
                    </div>
                </div>
            </section>
    
            <!-- Section 2 - detalhes anúncio -->
            <section>
                <div class="containerCalendario-pgAnuncio">
                    <p>Um calendário com as datas disponíveis</p>
                </div>
    
                <div class="containerHorasSemana-pgAnuncio">
                    <p>Horas em cada dia da semana que a quadra está indisponível</p>
                </div>
            </section>
        </div>

        <!-- Section 3 - Opções anúncio -->
        <section class="opcoesAnuncio">
            <div class="containerPrecoReserva">
                <!--<p>Valor por hora e detalhes</p>-->
                <h3>Valor por Hora</h3>
                <p>R$ 120,00 / hora</p>
            </div>
            <div class="containerBtnReserva">
                <!--<p>Botões reservar, salvar e etc</p>-->
                <button class="btn-reservar">Reservar Agora</button>
                <button class="btn-salvar">Salvar Anúncio</button>
            </div>
            <div class="containerPerfilInstituicao">
                <h3>Instituição Responsável</h3>
                <p>Perfil da instituição que possui a quadra, quandtidades de quadras que eles tem e etc...</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php 
        include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>