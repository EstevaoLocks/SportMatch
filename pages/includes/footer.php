<?php
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../../config.php';
?>

<!-- Footer -->
<footer>
    <div class="containerFooter">
        <div class="rowFooter">
            <div class="colLinksFooter">
                <div class="containerLogoFooter">
                    <div class="logo-imgFooter">
                        <img src="<?php echo BASE_URL; ?>/assets/img/Logo Branco.png" alt="">
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
                            <img id="iconeTelefone-Footer" class="iconeContato-Footer" src="<?php echo BASE_URL; ?>/assets/img/icons/iconeTelefone.svg" alt="Icone de telefone">
                            0800-SUPORTE-SPORT-MATCH
                        </a>
                    </li>
                    <li class="linkFooter">
                        <a class="linkContato-Footer" href="#">
                            <img id="iconeEmail-Footer" class="iconeContato-Footer" src="<?php echo BASE_URL; ?>/assets/img/icons/iconeEmail.svg" alt="Ícone de email">
                            suporte@sportmatch.com
                        </a>
                    </li>
                    <li class="linkFooter">
                        <a class="linkContato-Footer" href="#">
                            <img id="iconeWhatsapp-Footer" class="iconeWhatsapp-Footer" src="<?php echo BASE_URL; ?>/assets/img/icons/iconeWhatsapp.svg" alt="Ícone do WhatsApp">
                            (42)12345-6789
                        </a>
                    </li>
                    <li class="linkFooter">
                        <a class="linkContato-Footer" href="#">
                            <img id="iconeLocal-Footer" class="iconeLocal-Footer" src="<?php echo BASE_URL; ?>/assets/img/icons/iconeLocal.svg" alt="Ícone de localização">
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