<?php
    include "conexao.php";

    try {
        $stmt = $pdo->prepare("SELECT * FROM quadra");
        $stmt->execute();
        $quadras = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao buscar quadras: " . $e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Lista de Quadras</title>
</head>

<body>

    <!-- MENU -->
    <nav class="menu">
        <div class="logo">
            <div class="logo-img">
                <img src="assets/img/Logo Azul.png" alt="">
            </div>
            <div class="nome-site">
                <p>SportMatch</p>
                <p class="azul">Brasil</p>
            </div>
        </div>

        <div class="links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Registrar</a></li>
                <li class="ativo"><a href="listaDeQuadras.php">Quadras</a></li>
                <li><a href="#">Categorias</a></li>
                <li><a href="#">Perto de você</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </div>

        <div class="links">
            <div>
                <a class="btn-primary1 union" href="#">Cadastre-se</a>
                <a class="btn-secondary1 union" href="#">Login</a>
            </div>
        </div>
    </nav>

    <!-- CABEÇALHO -->
    <header class="home" style="height: 260px;">
        <div class="gradiente" style="justify-content: center;">
            <h1 style="font-size: 48px;">Lista de Quadras</h1>
            <p style="font-size: 20px;">Encontre a quadra ideal para você</p>
        </div>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main>

        <section style="padding: 40px 5%;">
            <h2 style="font-size: 32px; margin-bottom: 20px;">Quadras Disponíveis</h2>

            <div class="container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px;">

                <?php foreach ($quadras as $q): ?>

                    <div class="card" style="border-radius: 20px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); background: #fff;">

                        <!-- IMAGEM DA QUADRA -->
                        <img src="assets/img/quadraBaquete 1.png"
                             alt="Imagem da quadra"
                             style="width: 100%; height: 180px; object-fit: cover;">

                        <div class="bodyCard" style="padding: 20px;">

                            <p class="title" style="font-size: 22px; font-weight: 700;">
                                <?= $q['nome_quadra'] ?>
                            </p>

                            <p style="opacity: 0.8; margin: 5px 0;">
                                <?= $q['cidade'] ?> • <?= $q['bairro'] ?>
                            </p>

                            <p style="margin: 8px 0; font-size: 14px;">
                                Tamanho: <?= $q['tamanho'] ?><br>
                                Cobertura: <?= $q['cobertura'] ? "Sim" : "Não" ?><br>
                                Arquibancada: <?= $q['arquibancada'] ? "Sim" : "Não" ?>
                            </p>

                            <p style="font-size: 20px; font-weight: bold; margin-top: 10px;">
                                R$ <?= number_format($q['valor_hora'], 2, ',', '.') ?>/hora
                            </p>

                            <div class="containerBtnCard" style="margin-top: 15px;">
                                <a href="#" class="btnCard">Reservar</a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </section>

        <!-- SECTION 3 (FOOTER igual ao index) -->
        <section class="sectionPorqueEscolher">

            <div class="porqueContratar">
                <h2 class="title-porqueEscolher">Por que reservar através do SportMatch?</h2>
                <p class="subtitle-porqueEscolher">
                    Veja o quão mais fácil seu lazer e cuidados físicos se tornam:
                </p>
                <div class="row-porqueEscolher">
                    <div class="card-porqueEscolher"></div>
                </div>
            </div>

            <div class="porqueCadastrar">
                <h2 class="title-porqueEscolher">Por que cadastrar sua quadra no SportMatch?</h2>
                <p class="subtitle-porqueEscolher">
                    Dê vida à quadra do seu quintal ou mais visibilidade à sua quadra profissional
                </p>
                <div class="row-porqueEscolher">
                    <div class="card-porqueEscolher"></div>
                </div>
            </div>

        </section>

    </main>

</body>
</html>