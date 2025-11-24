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

   <title>Sobre — SportMatch</title>

<style>
        
        body {
        background-color: #0b2c5d;
        }

        .sobre-container {
            max-width: 1100px;
            margin: 60px auto;
            padding: 20px;
        }

        .sobre-hero {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 40px;
        }

        .sobre-texto {
            flex: 1;
        }

        .sobre-texto h1 {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 20px;
            background-color: #ffb400;
        }

        .sobre-texto p {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: #ffffff;
            line-height: 1.6rem;
        }

        .sobre-texto a {
            display: inline-block;
            margin-top: 10px;
        }

        .sobre-img img {
            width: 380px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgb(255, 255, 255);
        }
        
        /* Objetivo, Missão e Visão */
        .sobre-bloco {
            margin-top: 60px;
        }

        .sobre-bloco h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: #ffb400;
        }

        .sobre-card {
            background: #f3f3f3;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 5px 16px rgba(187, 72, 72, 0.12);
            margin-bottom: 18px;
        }

        .sobre-card h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .sobre-card p {
            color: #555;
            font-size: 1.05rem;
            line-height: 1.6rem;
        }

        /* Rodapé */
        .sobre-footer {
            margin-top: 60px;
            text-align: center;
            padding: 25px;
            font-size: 0.95rem;
            color: #666;
        }

        .sobre-footer span {
            color: #6f00ff;
            font-weight: 600;
        }

         @media (max-width: 780px) {
            .sobre-hero {
                text-align: center;
            }

            .sobre-img img {
                margin: 0 auto;
            }
        }

    </style>
</head>
<body>

    <?php
        include BASE_PATH . '/pages/includes/navbar.php';
    ?> 

    <!-- Conteúdo -->
    <main class="sobre-container">

        <!-- Hero -->
        <section class="sobre-hero">
            <div class="sobre-texto">
                <h1>Sobre o SportMatch</h1>
                <p>
                    O SportMatch nasceu com a missão de revolucionar o acesso ao esporte,
                    eliminando barreiras logísticas e facilitando a prática de atividades físicas.
                    Nosso projeto consiste em uma plataforma de busca e gestão de quadras, conectando proprietários a praticantes.
                    De forma rápida, organizada e acessível para conectar você ao esporte.
                </p>
                <p>
                    Aqui você encontra quadras de todas as modalidades, com preços variados,
                    horários disponíveis e avaliações reais de outros usuários.
                </p>

            </div>

            <div class="sobre-img">
                <img src="assets/img/basketball-player-action-sunset 1.png" alt="Esportes">
            </div>
        </section>


        <!-- OBJETIVO -->
        <section class="sobre-bloco">
            <h2>Objetivo</h2>

            <div class="sobre-card">
                <h3>Conectar quem quer jogar com quem oferece o espaço.</h3>
                <p>
                    Queremos facilitar a prática de esportes oferecendo um ambiente digital prático,
                    seguro e rápido, permitindo que jogadores encontrem quadras adequadas às suas necessidades
                    e proprietários aumentem sua visibilidade.
                </p>
            </div>
        </section>

        <!-- MISSÃO -->
        <section class="sobre-bloco">
            <h2>Missão</h2>

            <div class="sobre-card">
                <h3>Facilitar o acesso ao esporte.</h3>
                <p>
                    Tornar o processo de reservar e anunciar quadras uma experiência intuitiva,
                    com transparência e eficiência, incentivando hábitos saudáveis.
                </p>
            </div>
        </section>

        <!-- VISÃO -->
        <section class="sobre-bloco">
            <h2>Visão</h2>

            <div class="sobre-card">
                <h3> plataforma eficiênte de reserva de quadras.</h3>
                <p>
                    Expandir continuamente a variedade de quadras, modalidades e regiões atendidas,
                    oferecendo sempre o melhor suporte, tecnologia e experiência aos usuários.
                </p>
            </div>
        </section>

        <!-- Desenvolvido por -->
        <div class="sobre-footer">
            Desenvolvido por Estevão, Ana, Geovana, João gabriel e Izan </span> — todos os direitos reservados ©
        </div>

    </main>

<!-- Footer -->
    <?php 
        include BASE_PATH . '/pages/includes/footer.php';
    ?>

    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
