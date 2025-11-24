<?php
    require_once __DIR__ . '/config.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // A conexão está dentro da pasta pages
    require_once __DIR__ . '/pages/conexao.php';

    $userId = $_SESSION['id'] ?? null;
    $userType = $_SESSION['tipo_usuario'] ?? null;
    
    // Verifica se o arquivo de conexão existe antes de incluir para evitar erro fatal direto
    if (file_exists(__DIR__ . '/pages/conexao.php')) {
        require_once __DIR__ . '/pages/conexao.php';
    } else {
        die("Erro: Arquivo de conexão não encontrado em /pages/conexao.php");
    }

    // Consulta para buscar modalidades e contar quantas quadras existem em cada uma
    try {
        $sql = "SELECT m.cod_modalidade, m.nome_mod, COUNT(qm.cod_quadra) as total_quadras 
                FROM modalidade m 
                LEFT JOIN quadra_mod qm ON m.cod_modalidade = qm.cod_modalidade 
                GROUP BY m.cod_modalidade, m.nome_mod
                ORDER BY total_quadras DESC"; // Mostra as que tem mais quadras primeiro
        
        $stmt = $pdo->query($sql);
        $categorias = $stmt->fetchAll();
    } catch (PDOException $e) {
        $categorias = [];
        echo "Erro ao buscar categorias: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontes Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">

    <!-- Ícone Navegador -->
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/assets/img/ico/logo-azul-32.ico">

    <title>Home - SportMatch</title>
</head>

<body>
    <?php
        include BASE_PATH . '/pages/includes/navbar.php';
    ?>

    <!-- Conteúdo Principal -->
    <main>
        <!-- Cabeçalho Home -->
        <header class="home">
            <div class="gradiente">
                <div class="conteudo-header">
                    <h1>Quem <code>espera</code> a bola vir no pé, <code>perde</code> o <code>chute</code></h1>
                    <p>Reserve ou cadastre sua quadra já!</p>

                    <div class="btns-header">
                        <a href="<?php echo BASE_URL; ?>/pages/conta/registro.php" class="btn-primary2">Cadastre-se já!</a>
                    </div>
                </div>

                <div class="figura">
                    <img src="assets/img/figuraMouse.png" alt="Icone de mouse">
                </div>
            </div>
        </header>

        <!-- Section 1 - Propaganda -->
        <section class="sectionPropaganda">
            <img class="imgBolaBasquete" src="assets/img/basket ball img.png" alt="Imagem de bola de basquete">
            <img class="imgJogadorBasquete" src="assets/img/basketball-player-action-sunset 1.png" alt="Imagem de jogador de basquete">
            <p class="textAbsolute">Cadastre e alugue sua quadra aqui</p>

            <div class="containerCards">
                <div class="cardPropaganda">
                    <img src="assets/img/quadra de quintal 1.png" alt="">
                    <div class="bodyCard">
                        <p class="descricao">A quadra da sua casa aqui!</p>
                        <p class="title">Quadra de Quintal</p>
                    </div>
                </div>

                <div class="cardPropaganda">
                    <img src="assets/img/Quadra-de-Futsal-profissional 1.png" alt="">
                    <div class="bodyCard">
                        <p class="descricao">Sua quadra profissional aqui!</p>
                        <p class="title">Quadra Profissional</p>
                    </div>
                </div>
            </div>

            <div class="containerBtn">
                <a class="btn-primary1" href="<?php echo BASE_URL; ?>/pages/categorias.php">Veja mais</a>
            </div>
        </section>

        <!-- Section 2 - Nossas Categorias (DINÂMICA) -->
        <section class="sectionNossasCategorias">
            <h2 class="titleContratante">Nossas Categorias</h2>
            <p class="subTitleContratante">Para todos os gostos existe um esporte e a quadra para ele você pode reservar aqui!</p>
            
            <div class="container">
                <!-- Única ROW para permitir wrap automático dos cards -->
                <div class="row" style="justify-content: center; gap: 30px;">
                    
                    <?php if (count($categorias) > 0): ?>
                        <?php foreach ($categorias as $cat): ?>
                            <?php
                                // Lógica para escolher a imagem baseada no nome do esporte
                                $nome = mb_strtolower($cat['nome_mod']);
                                $imgCard = 'assets/img/campo-baseball.png'; // Imagem padrão

                                if (strpos($nome, 'basquete') !== false) {
                                    $imgCard = 'assets/img/quadraBaquete 1.png';
                                } elseif (strpos($nome, 'futebol') !== false || strpos($nome, 'futsal') !== false) {
                                    $imgCard = 'assets/img/estadioFutebol.png';
                                } elseif (strpos($nome, 'vôlei') !== false || strpos($nome, 'volei') !== false) {
                                    $imgCard = 'assets/img/quadra-de-volei4 1.png';
                                } elseif (strpos($nome, 'tênis') !== false || strpos($nome, 'tenis') !== false) {
                                    $imgCard = 'assets/img/quadraTenis.png';
                                } elseif (strpos($nome, 'badminton') !== false) {
                                    $imgCard = 'assets/img/quadraBadminton.png';
                                }
                            ?>

                            <div class="card">
                                <img src="<?php echo $imgCard; ?>" alt="Imagem de <?php echo $cat['nome_mod']; ?>">
                                <div class="bodyCard">
                                    <p class="title"><?php echo htmlspecialchars($cat['nome_mod']); ?></p>
                                    
                                    <!-- Mostra quantidade real do banco -->
                                    <p><?php echo $cat['total_quadras']; ?> opções disponíveis</p>
                                    
                                    <div class="containerStars">
                                        <img src="assets/img/Estrela.png">
                                        <img src="assets/img/Estrela.png">
                                        <img src="assets/img/Estrela.png">
                                        <img src="assets/img/Estrela.png">
                                        <img src="assets/img/Estrela.png">
                                    </div>
                                    
                                    <!-- Link direto para a página de busca com o filtro ativado -->
                                    <div class="containerBtnCard">
                                        <a class="btnCard" href="<?php echo BASE_URL; ?>/pages/categorias.php?modalidade=<?php echo $cat['cod_modalidade']; ?>">
                                            Veja Mais
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="text-align: center; width: 100%;">Nenhuma categoria encontrada.</p>
                    <?php endif; ?>

                </div>
            </div>
        </section>

        <!-- Section 3 - Perto de Você -->
        <section class="sectionPertoVoce">
            <h2 class="titleContratante">Quadras perto de você</h2>
            <p class="subTitleContratante">Explore as melhores opções ao seu lado!</p>

            <div class="row-pertoVoce">
                <div class="card-pertoVoce">
                    <div class="gradienteCard-pertoVoce"></div>
                    <img class="cardImg-pertoVoce" src="assets/img/Lugares/bairros-de-ribeirao-pires 1.png" alt="">
                    <div class="containerLocal-pertoVoce">
                        <img id="iconeLocalCard1" class="icone-pertoVoce" src="assets/img/icons/iconeLocal.svg" alt="">
                        <p class="titleCard-pertoVoce">Ribeirão Pires</p>
                    </div>
                </div>

                <div class="card-pertoVoce">
                    <div class="gradienteCard-pertoVoce"></div>
                    <img class="cardImg-pertoVoce" src="assets/img/Lugares/Maua-SP-740x415-1 1.png" alt="">
                    <div class="containerLocal-pertoVoce">
                        <img id="iconeLocalCard2" class="icone-pertoVoce" src="assets/img/icons/iconeLocal.svg" alt="">
                        <p class="titleCard-pertoVoce">Mauá</p>
                    </div>
                </div>

                <div class="card-pertoVoce">
                    <div class="gradienteCard-pertoVoce"></div>
                    <img class="cardImg-pertoVoce" src="assets/img/Lugares/prefeitura-de-santo-andre-860x570 1.png" alt="">
                    <div class="containerLocal-pertoVoce">
                        <img id="iconeLocalCard3" class="icone-pertoVoce" src="assets/img/icons/iconeLocal.svg" alt="">
                        <p class="titleCard-pertoVoce">Santo André</p>
                    </div>
                </div>

                <div class="card-pertoVoce">
                    <div class="gradienteCard-pertoVoce"></div>
                    <img class="cardImg-pertoVoce" src="assets/img/Lugares/imagem Suzano.png" alt="">
                    <div class="containerLocal-pertoVoce">
                        <img id="iconeLocalCard4" class="icone-pertoVoce" src="assets/img/icons/iconeLocal.svg" alt="">
                        <p class="titleCard-pertoVoce">Suzano</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4 - Porque escolher-nos -->
        <section class="sectionPorqueEscolher">
            <div class="porqueContratar">
                <h2 class="title-porqueEscolher">Por que reservar através do SportMatch?</h2>
                <p class="subtitle-porqueEscolher">Veja o quão mais fácil seu lazer e cuidados físicos se tornam:</p>
                <div class="row-porqueEscolher">
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueReservar"><img src="assets/img/icons/iconeRelogio.png"></div>
                        <p class="titleCard-porqueEscolher">Sistema de Agendamento</p>
                        <p class="descricaoCard-porqueEscolher">Saiba exatamente quando as quadras estiverem livres</p>
                    </div>
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueReservar"><img src="assets/img/icons/iconeCartao.png"></div>
                        <p class="titleCard-porqueEscolher">Pesquisa de Preço</p>
                        <p class="descricaoCard-porqueEscolher">Aqui você consegue ver todos os preços e ver qual se encaixa em seu bolso</p>
                    </div>
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueReservar"><img src="assets/img/icons/iconeLocal.png"></div>
                        <p class="titleCard-porqueEscolher">Locais</p>
                        <p class="descricaoCard-porqueEscolher">Saiba todas as quadras perto de você</p>
                    </div>
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueReservar"><img src="assets/img/icons/IconeGlobo.png"></div>
                        <p class="titleCard-porqueEscolher">Reserva fácil</p>
                        <p class="descricaoCard-porqueEscolher">Reserve um horário em qualquer quadra em alguns cliques</p>
                    </div>
                </div>
            </div>

            <div class="porqueCadastrar">
                <h2 class="title-porqueEscolher">Por que cadastrar sua quadra no SportMatch?</h2>
                <p class="subtitle-porqueEscolher">Dê vida à quadra do seu quintal ou mais visibilidade à sua quadra profissional</p>
                <div class="row-porqueEscolher">
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueCadastrar"><img src="assets/img/icons/iconeRelogio.png"></div>
                        <p class="titleCard-porqueEscolher">Sistema de Agendamento</p>
                        <p class="descricaoCard-porqueEscolher">Sua quadra durante o tempo que puder</p>
                    </div>
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueCadastrar"><img src="assets/img/icons/iconeCartao.png"></div>
                        <p class="titleCard-porqueEscolher">Monetize sua quadra</p>
                        <p class="descricaoCard-porqueEscolher">Cadastre sua quadra sem muito uso e transforme ela em uma renda extra!</p>
                    </div>
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueCadastrar"><img src="assets/img/icons/iconeOlho.png"></div>
                        <p class="titleCard-porqueEscolher">Mais visibilidade</p>
                        <p class="descricaoCard-porqueEscolher">Sua quadra ficará visível a todos os usuários da plataforma!</p>
                    </div>
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueCadastrar"><img src="assets/img/icons/IconeGlobo.png"></div>
                        <p class="titleCard-porqueEscolher">Reserva fácil</p>
                        <p class="descricaoCard-porqueEscolher">Sem complicações com agendamento e preço, tudo é informado e resolvido aqui!</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include BASE_PATH . '/pages/includes/footer.php' ?>
    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>