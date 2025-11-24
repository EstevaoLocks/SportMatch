<?php
    require_once __DIR__ . '/../config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - SportMatch</title>
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/sobre.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="body-sobre">

    <?php include BASE_PATH . '/pages/includes/navbar.php'; ?>

    <main class="main-sobre">
        
        <!-- Seção Hero (Mantida) -->
        <section class="sobre-hero">
            <div class="container-sobre">
                <div class="hero-content">
                    <div class="hero-text">
                        <span class="tagline">CONECTANDO PAIXÃO E ESPAÇO</span>
                        <h1>O Jogo Começa <br><span class="text-teal">Aqui.</span></h1>
                        <p>
                            O <strong>SportMatch</strong> nasceu com uma missão clara: derrubar as barreiras que te impedem de praticar esporte. 
                            Somos a ponte digital entre atletas que buscam o lugar perfeito para jogar e proprietários de quadras que querem ver seus espaços cheios de vida.
                        </p>
                        <div class="hero-buttons">
                            <a href="<?php echo BASE_URL; ?>/pages/registro.php" class="btn-primary-sobre">Começar Agora</a>
                        </div>
                    </div>
                    
                    <div class="hero-image">
                        <div class="image-wrapper">
                            <img src="<?php echo BASE_URL; ?>/assets/img/basketball-player-action-sunset 1.png" alt="Jogador de Basquete">
                            <div class="img-backdrop"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- NOVA SEÇÃO: COMO FUNCIONA -->
        <section class="como-funciona-section">
            <div class="container-sobre">
                <div class="section-header">
                    <h2>Como Funciona</h2>
                    <p>Simples, rápido e direto ao ponto para todos.</p>
                </div>

                <div class="funcionalidades-wrapper">
                    
                    <!-- Lado do Atleta -->
                    <div class="func-coluna atleta">
                        <div class="coluna-header">
                            <i class="fas fa-running"></i>
                            <h3>Para Atletas</h3>
                        </div>
                        <div class="steps-list">
                            <div class="step-item">
                                <span class="step-number">1</span>
                                <div class="step-content">
                                    <h4>Encontre</h4>
                                    <p>Busque por modalidade, localização ou preço e ache a quadra perfeita perto de você.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <span class="step-number">2</span>
                                <div class="step-content">
                                    <h4>Reserve</h4>
                                    <p>Veja a disponibilidade em tempo real e garanta seu horário em poucos cliques.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <span class="step-number">3</span>
                                <div class="step-content">
                                    <h4>Jogue</h4>
                                    <p>Receba a confirmação, chame a galera e só se preocupe em entrar em campo.</p>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo BASE_URL; ?>/pages/quadras.php" class="btn-link-func">Buscar Quadras <i class="fas fa-arrow-right"></i></a>
                    </div>

                    <!-- Divisor Visual (Linha vertical) -->
                    <div class="divisor-vertical"></div>

                    <!-- Lado da Instituição -->
                    <div class="func-coluna instituicao">
                        <div class="coluna-header">
                            <i class="fas fa-building"></i>
                            <h3>Para Proprietários</h3>
                        </div>
                        <div class="steps-list">
                            <div class="step-item">
                                <span class="step-number">1</span>
                                <div class="step-content">
                                    <h4>Cadastre</h4>
                                    <p>Crie o perfil da sua instituição e cadastre suas quadras com fotos e detalhes.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <span class="step-number">2</span>
                                <div class="step-content">
                                    <h4>Gerencie</h4>
                                    <p>Tenha controle total da sua agenda, preços e reservas em um painel intuitivo.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <span class="step-number">3</span>
                                <div class="step-content">
                                    <h4>Lucre</h4>
                                    <p>Aumente sua visibilidade, receba novos clientes e elimine horários ociosos.</p>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo BASE_URL; ?>/pages/registro.php?tipo=instituicao" class="btn-link-func">Cadastrar Minha Quadra <i class="fas fa-arrow-right"></i></a>
                    </div>

                </div>
            </div>
        </section>

        <!-- Seção Pilares (Mantida) -->
        <section class="pilares-section">
            <div class="container-sobre">
                <div class="section-header">
                    <h2>Nossos Pilares</h2>
                    <p>O que nos move a entrar em campo todos os dias</p>
                </div>

                <div class="cards-grid">
                    <div class="card-pilar">
                        <div class="icon-pilar"><i class="fas fa-bullseye"></i></div>
                        <h3>Objetivo</h3>
                        <p>Criar um ecossistema onde encontrar uma quadra seja tão fácil quanto calçar um tênis.</p>
                    </div>
                    <div class="card-pilar">
                        <div class="icon-pilar"><i class="fas fa-rocket"></i></div>
                        <h3>Missão</h3>
                        <p>Democratizar o acesso ao esporte, transformando a reserva de quadras em uma experiência transparente.</p>
                    </div>
                    <div class="card-pilar">
                        <div class="icon-pilar"><i class="fas fa-globe-americas"></i></div>
                        <h3>Visão</h3>
                        <p>Ser a referência nacional em gestão esportiva, expandindo modalidades e regiões com tecnologia de ponta.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Time (Mantido) -->
        <section class="team-section">
            <div class="container-sobre">
                <div class="section-header">
                    <h2>Quem Faz Acontecer</h2>
                    <p>O time por trás de cada linha de código e cada pixel</p>
                </div>

                <div class="team-grid">
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="/../../assets" alt="Estevão">
                        </div>
                        <h3>Estevão</h3>
                        <span class="team-role">Fullstack Developer</span>
                    </div>
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://ui-avatars.com/api/?name=Ana&background=F4743B&color=fff&size=200" alt="Ana">
                        </div>
                        <h3>Ana</h3>
                        <span class="team-role">Frontend / UI Design</span>
                    </div>
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://ui-avatars.com/api/?name=Geovana&background=70D4D6&color=02050A&size=200" alt="Geovana">
                        </div>
                        <h3>Geovana</h3>
                        <span class="team-role">Banco de Dados</span>
                    </div>
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://ui-avatars.com/api/?name=Joao+Gabriel&background=F4743B&color=fff&size=200" alt="João Gabriel">
                        </div>
                        <h3>João Gabriel</h3>
                        <span class="team-role">Backend Developer</span>
                    </div>
                    <div class="team-card">
                        <div class="team-img-wrapper">
                            <img src="https://ui-avatars.com/api/?name=Izan&background=70D4D6&color=02050A&size=200" alt="Izan">
                        </div>
                        <h3>Izan</h3>
                        <span class="team-role">Gestão de Projeto / QA</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA (Mantido) -->
        <section class="cta-section">
            <div class="container-sobre">
                <div class="cta-box">
                    <h2>Pronto para entrar em quadra?</h2>
                    <p>Junte-se a milhares de esportistas e proprietários.</p>
                    <div class="cta-buttons">
                        <a href="<?php echo BASE_URL; ?>/pages/registro.php?tipo=atleta" class="btn-cta-teal">Sou Atleta</a>
                        <a href="<?php echo BASE_URL; ?>/pages/registro.php?tipo=instituicao" class="btn-cta-outline">Tenho uma Quadra</a>
                    </div>
                </div>
                <p class="copyright" style="margin-top: 40px; text-align: center; color: #5a6575;">SportMatch Brasil © <?php echo date('Y'); ?></p>
            </div>
        </section>

    </main>

    <?php include BASE_PATH . '/pages/includes/footer.php'; ?>
    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>