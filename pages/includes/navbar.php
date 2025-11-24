<?php
//chama arquivo que define raíz do projeto
require_once __DIR__ . '/../../config.php';
?>

<nav class="menu">
    <div class="logo">
        <div class="logo-img">
            <img src="<?php echo BASE_URL; ?>/assets/img/Logo Azul.png" alt="">
        </div>
        <div class="nome-site">
            <p>SportMatch</p>
            <p class="azul">Brasil</p>
        </div>
    </div>

    <!-- Botão Hamburguer -->
    <div class="mobile-menu-icon" onclick="toggleMenu()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>

    <!-- MENU MOBILE / DESKTOP -->
    <div class="menu-links" id="mobileMenu">
        <!-- Suas DIVS originais -->
        <div class="links">
            <ul>
                <li><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/conta/registro.php">Registrar</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/categorias.php">Categorias</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/pertodevoce.php">Perto de você</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/sobre.php">Por que escolher?</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/contato.php">Contato</a></li>
            </ul>
        </div>

        <div class="links">
            <?php if (basename($_SERVER['PHP_SELF']) != 'profile.php' && basename($_SERVER['PHP_SELF']) != 'quadrasReservadas.php' && basename($_SERVER['PHP_SELF']) != 'favoritos.php' && basename($_SERVER['PHP_SELF']) != 'configuracaoProfile.php'): ?>
                <?php if ((isset($_SESSION['cod_usuario'])) and (isset($_SESSION['nome'])) and (isset($_SESSION['email']))): ?>
                    <div>
                        <a class="btnLogadoPerfil-menu" href="<?php echo BASE_URL; ?>/pages/profile/profile.php"><img id="iconePersonBtnMenu" class="iconePerson-BtnMenuLogado" src="<?php echo BASE_URL; ?>/assets/img/icons/iconePerson.svg" alt=""></a>
                    </div>
                <?php else: ?>
                    <div>
                        <a class="btn-secondary1-menu" href="<?php echo BASE_URL; ?>/pages/conta/login.php">Login<img id="iconePersonBtnMenu" class="iconePerson-BtnMenu" src="<?php echo BASE_URL; ?>/assets/img/icons/iconePerson.svg" alt=""></a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</nav>