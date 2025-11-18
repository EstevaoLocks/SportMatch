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
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Ícone Navegador -->
    <link rel="icon" type="image/x-icon" href="assets/img/ico/logo-azul-32.ico">

    <title>Home</title>
</head>

<body>
    <?php 
        include 'navbar.php';
    ?>

    <!-- Conteúdo Principal ----------- -->
    <main>
        <!-- Cabeçalho Home -->
        <header class="home">
            <!-- Gradiente -->
            <div class="gradiente">
                <!-- Conteúdo Header -->
                <div class="conteudo-header">
                    <!-- Textos -->
                    <h1>Quem <code>espera</code> a bola vir no pé, <code>perde</code> o <code>chute</code></h1>
                    <p>Reserve ou cadastre sua quadra já!</p>
    
                    <!-- Botões -->
                    <div class="btns-header">
                        <a class="btn-primary2" href="#">Cadastre-se já!</a>
                    </div>
                </div>
    
                <!-- Figura -->
                <div class="figura">
                    <img src="assets/img/figuraMouse.png" alt="Icone de mouse">
                </div>
            </div>
        </header>

        <!-- Section 1 - Propaganda -->
        <section class="sectionPropaganda">
            <!-- Conteúdo Absoluto -->
            <img class="imgBolaBasquete" src="assets/img/basket ball img.png" alt="Imagem de bola de basquete">
            <img class="imgJogadorBasquete" src="assets/img/basketball-player-action-sunset 1.png" alt="Imagem de jogador de basquete">
            <p class="textAbsolute">Cadastre e alugue sua quadra aqui</p>

            <!-- Cards -->
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

            <!-- Button -->
            <div class="containerBtn">
                <a class="btn-primary1" href="#">Veja mais</a>
            </div>
        </section><!-- Fim Section 1 - Propaganda -->

        <!-- Section 2 - Nossas Categorias -->
        <section class="sectionNossasCategorias">
            <h2 class="titleContratante">Nossas Categorias</h2>
            <p class="subTitleContratante">Para todos os gostos existe um esporte e a quadra para ele você pode reservar aqui!</p>
            <div class="container">

                <!-- Linha 1 -->
                <div class="row">
                    <!-- Card 1 -->
                    <div class="card">
                        <img src="assets/img/quadraBaquete 1.png" alt="Imagem de quadra de basquete">
                        <div class="bodyCard">
                            <p class="title">Basquete</p>
                            <p>241 opções</p>
                            <div class="containerStars">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                            </div>
                            <p>10m x 20m</p>
                            <div class="containerBtnCard">
                                <a class="btnCard" href="">Veja Mais</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="card">
                        <img src="assets/img/estadioFutebol.png" alt="Imagem de estádio de futebol">
                        <div class="bodyCard">
                            <p class="title">Futebol</p>
                            <p>47 opções</p>
                            <div class="containerStars">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                            </div>
                            <p>40m x 60m</p>
                            <div class="containerBtnCard">
                                <a class="btnCard" href="">Veja Mais</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="card">
                        <img src="assets/img/quadra-de-volei4 1.png" alt="Imagem de quadra de vôlei">
                        <div class="bodyCard">
                            <p class="title">Vôlei</p>
                            <p>112 opções</p>
                            <div class="containerStars">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                            </div>
                            <p>18m x 9m</p>
                            <div class="containerBtnCard">
                                <a class="btnCard" href="">Veja Mais</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Linha 2 -->
                <div class="row">
                    <!-- Card 4 -->
                    <div class="card">
                        <img src="assets/img/quadraTenis.png" alt="Imagem de quadra de tênis">
                        <div class="bodyCard">
                            <p class="title">Tênis</p>
                            <p>65 opções</p>
                            <div class="containerStars">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                            </div>
                            <p>18m x 9m</p>
                            <div class="containerBtnCard">
                                <a class="btnCard" href="">Veja Mais</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="card">
                        <img src="assets/img/quadraBadminton.png" alt="Imagem de estádio de badminton">
                        <div class="bodyCard">
                            <p class="title">Badminton</p>
                            <p>23 opções</p>
                            <div class="containerStars">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                            </div>
                            <p>4m x 8m</p>
                            <div class="containerBtnCard">
                                <a class="btnCard" href="">Veja Mais</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="card">
                        <img src="assets/img/campo-baseball.png" alt="Imagem de quadra de basebol">
                        <div class="bodyCard">
                            <p class="title">Outras Categorias</p>
                            <p>Mais de 500 opções</p>
                            <div class="containerStars">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                                <img src="assets/img/Estrela.png" alt="Imagem de estrela">
                            </div>
                            <p>20m x 20m</p>
                            <div class="containerBtnCard">
                                <a class="btnCard" href="">Veja Mais</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- Fim Section 2 - Nossas Categorias -->

        <!-- Section 3 - Perto de Você -->
        <section class="sectionPertoVoce">
            <h2 class="titleContratante">Quadras perto de você</h2>
            <p class="subTitleContratante">Explore as melhores opções ao seu lado!</p>

            <div class="row-pertoVoce">
                <!-- Card 1 -->
                <div class="card-pertoVoce">
                    <div class="gradienteCard-pertoVoce"></div>
                    <img class="cardImg-pertoVoce" src="assets/img/Lugares/bairros-de-ribeirao-pires 1.png" alt="Ícone de relógio">
                    <div class="containerLocal-pertoVoce">
                        <!-- Img que será convertida em SVG -->
                        <img id="iconeLocalCard1" class="icone-pertoVoce" src="assets/img/icons/iconeLocal.svg" alt="">
                        <p class="titleCard-pertoVoce">Ribeirão Pires</p>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="card-pertoVoce">
                    <div class="gradienteCard-pertoVoce"></div>
                    <img class="cardImg-pertoVoce" src="assets/img/Lugares/Maua-SP-740x415-1 1.png" alt="Ícone de relógio">
                    <div class="containerLocal-pertoVoce">
                        <!-- Img que será convertida em SVG -->
                        <img id="iconeLocalCard2" class="icone-pertoVoce" src="assets/img/icons/iconeLocal.svg" alt="">
                        <p class="titleCard-pertoVoce">Mauá</p>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="card-pertoVoce">
                    <div class="gradienteCard-pertoVoce"></div>
                    <img class="cardImg-pertoVoce" src="assets/img/Lugares/prefeitura-de-santo-andre-860x570 1.png" alt="Ícone de relógio">
                    <div class="containerLocal-pertoVoce">
                        <!-- Img que será convertida em SVG -->
                        <img id="iconeLocalCard3" class="icone-pertoVoce" src="assets/img/icons/iconeLocal.svg" alt="">
                        <p class="titleCard-pertoVoce">Santo André</p>
                    </div>
                </div>
                
                <!-- Card 4 -->
                <div class="card-pertoVoce">
                    <div class="gradienteCard-pertoVoce"></div>
                    <img class="cardImg-pertoVoce" src="assets/img/Lugares/imagem Suzano.png" alt="Ícone de relógio">
                    <div class="containerLocal-pertoVoce">
                        <!-- Img que será convertida em SVG -->
                        <img id="iconeLocalCard4" class="icone-pertoVoce" src="assets/img/icons/iconeLocal.svg" alt="">
                        <p class="titleCard-pertoVoce">Suzano</p>
                    </div>
                </div>
            </div><!-- Fim Row -->
        </section>

        <!-- Section 4 - Porque escolher-nos -->
        <section class="sectionPorqueEscolher">
            <div class="porqueContratar">
                <h2 class="title-porqueEscolher">Por que reservar através do SportMatch?</h2>
                <p class="subtitle-porqueEscolher">Veja o quão mais fácil seu lazer e cuidados físicos se tornam:</p>
                <div class="row-porqueEscolher">
                    <!-- Card 1 -->
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueReservar">
                            <img src="assets/img/icons/iconeRelogio.png" alt="Ícone de relógio">
                        </div>
                        <p class="titleCard-porqueEscolher">Sistema de Agendamento</p>
                        <p class="descricaoCard-porqueEscolher">Saiba exatamente quando as quadras estiverem livres</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueReservar">
                            <img src="assets/img/icons/iconeCartao.png" alt="Ícone de relógio">
                        </div>
                        <p class="titleCard-porqueEscolher">Pesquisa de Preço</p>
                        <p class="descricaoCard-porqueEscolher">Aqui você consegue ver todos os preços e ver qual se encaixa em seu bolso</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueReservar">
                            <img src="assets/img/icons/iconeLocal.png " alt="Ícone de relógio">
                        </div>
                        <p class="titleCard-porqueEscolher">Locais</p>
                        <p class="descricaoCard-porqueEscolher">Saiba todas as quadras perto de você</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueReservar">
                            <img src="assets/img/icons/IconeGlobo.png" alt="Ícone de relógio">
                        </div>
                        <p class="titleCard-porqueEscolher">Reserva fácil</p>
                        <p class="descricaoCard-porqueEscolher">Reserve um horário em qualquer quadra em alguns cliques</p>
                    </div>
                </div>
            </div>

            <div class="porqueCadastrar">
                <h2 class="title-porqueEscolher">Por que cadastrar sua quadra no SportMatch?</h2>
                <p class="subtitle-porqueEscolher">Dê vida à quadra do seu quintal ou mais visibilidade à sua quadra profissional</p>
                <div class="row-porqueEscolher">
                    <!-- Card 1 -->
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueCadastrar">
                            <img src="assets/img/icons/iconeRelogio.png" alt="Ícone de relógio">
                        </div>
                        <p class="titleCard-porqueEscolher">Sistema de Agendamento</p>
                        <p class="descricaoCard-porqueEscolher">Sua quadra durante o tempo que puder</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueCadastrar">
                            <img src="assets/img/icons/iconeCartao.png" alt="Ícone de relógio">
                        </div>
                        <p class="titleCard-porqueEscolher">Monetize sua quadra</p>
                        <p class="descricaoCard-porqueEscolher">Cadastre sua quadra sem muito uso e transforme ela em uma renda extra!</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueCadastrar">
                            <img src="assets/img/icons/iconeOlho.png" alt="Ícone de relógio">
                        </div>
                        <p class="titleCard-porqueEscolher">Mais visibilidade</p>
                        <p class="descricaoCard-porqueEscolher">Sua quadra ficará visível a todos os usuários da plataforma!</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="card-porqueEscolher">
                        <div class="iconeCard-porqueCadastrar">
                            <img src="assets/img/icons/IconeGlobo.png" alt="Ícone de relógio">
                        </div>
                        <p class="titleCard-porqueEscolher">Reserva fácil</p>
                        <p class="descricaoCard-porqueEscolher">Sem complicações com agendamento e preço, tudo é informado e resolvido aqui!</p>
                    </div>
                </div>
            </div>
        </section><!-- Fim Porque escolher-nos  -->
    </main>

    <!-- Footer -->
     <footer>
        <div class="containerFooter">
            <div class="rowFooter">
                <div class="colLinksFooter">
                    <div class="containerLogoFooter">
                        <div class="logo-imgFooter">
                            <img src="assets/img/Logo Branco.png" alt="">
                        </div>
                        <div class="nome-siteFooter">
                            <p>SportMatch</p>
                            <p class="azul">Brasil</p>
                        </div>
                    </div>
                    <p>Encontre uma quadra seja onde for</p>
                </div>

                <div class="colLinksFooter">
                    <h6 class="tituloLinksFooter">Serviços</h6>
                    <ul>
                        <li class="linkFooter"><a href="#">Crie uma conta</a></li>
                        <li class="linkFooter"><a href="#">Procure quadras</a></li>
                    </ul>
                </div>

                <div class="colLinksFooter">
                    <h6 class="tituloLinksFooter">Páginas</h6>
                    <ul>
                        <li class="linkFooter"><a href="#">Home</a></li>
                        <li class="linkFooter"><a href="#">Login</a></li>
                        <li class="linkFooter"><a href="#">Pesquisar</a></li>
                        <li class="linkFooter"><a href="#">Sua conta</a></li>
                    </ul>
                </div>

                <div class="colLinksFooter">
                    <h6 class="tituloLinksFooter">Contate-nos</h6>
                    <ul>
                        <li class="linkFooter">
                            <a class="linkContato-Footer" href="#">
                                <img id="iconeTelefone-Footer" class="iconeContato-Footer" src="assets/img/icons/iconeTelefone.svg" alt="Icone de telefone">
                                0800-SUPORTE-SPORT-MATCH
                            </a>
                        </li>
                        <li class="linkFooter">
                            <a class="linkContato-Footer" href="#">
                                <img id="iconeEmail-Footer" class="iconeContato-Footer" src="assets/img/icons/iconeEmail.svg" alt="Ícone de email">
                                suporte@sportmatch.com
                            </a>
                        </li>
                        <li class="linkFooter">
                            <a class="linkContato-Footer" href="#">
                                <img id="iconeWhatsapp-Footer" class="iconeWhatsapp-Footer" src="assets/img/icons/iconeWhatsapp.svg" alt="Ícone do WhatsApp">
                                (42)12345-6789
                            </a>
                        </li>
                        <li class="linkFooter">
                            <a class="linkContato-Footer" href="#">
                                <img id="iconeLocal-Footer" class="iconeLocal-Footer" src="assets/img/icons/iconeLocal.svg" alt="Ícone de localização">
                                Em todos os estados do Brasil!
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="linhaFooter">
            <div class="rowFooter">
                <div class="colBottomFooter">
                    <p>&copy; <a href="#" class="linkFooter">2025 SportMatch</a>. Todos os direitos reservados.</p>
                </div>
                <div class="colBottomFooter colBottomRightFooter">
                    <ul class="linksBottomFooter">
                        <li class="linkFooter"><a href="">Privacy Plicy</a></li>
                        <li class="linkFooter"><a href="">Termos de Serviço</a></li>
                        <li class="linkFooter"><a href="">Safety</a></li>
                    </ul>
                </div>
            </div>
        </div>
     </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>