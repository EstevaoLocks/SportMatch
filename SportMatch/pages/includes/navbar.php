<?php
// Garante que o config só seja chamado se ainda não foi definido para evitar erros
if (!defined('BASE_URL')) {
    require_once __DIR__ . '/../../config.php';
}
?>

<!-- Importa o CSS Responsivo específico da Navbar -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/responsive_navbar.css">

<nav class="menu">
    <!-- Logo -->
    <div class="logo">
        <a href="<?php echo BASE_URL; ?>/index.php" class="logo-img">
            <img src="<?php echo BASE_URL; ?>/assets/img/Logo Azul.png" alt="Logo SportMatch">
        </a>
        <div class="nome-site">
            <p>SportMatch</p>
            <p class="azul">Brasil</p>
        </div>
    </div>

    <!-- Botão Sanduíche (Só aparece no mobile) -->
    <div class="mobile-menu-icon" onclick="toggleMenu()">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

    <!-- Container dos Links (Colapsável no Mobile) -->
    <div class="nav-menu" id="navMenu">
        <div class="links">
            <ul>
                <li><a href="<?php echo BASE_URL; ?>/index.php">Home</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/Conta/registro.php">Registrar</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/categorias.php">Categorias</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/pertodevoce.php">Perto de você</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/sobre.php">Por que escolher?</a></li>
                <li><a href="<?php echo BASE_URL; ?>/pages/contato.php">Contato</a></li>
            </ul>
        </div>

        <!-- Área de Login / Perfil -->
        <div class="links login-area">
            <?php 
                // Verifica em qual página estamos para esconder o botão de login nas páginas de auth/perfil
                $paginaAtual = basename($_SERVER['PHP_SELF']);
                $paginasSemLogin = ['profile.php', 'quadrasReservadas.php', 'favoritos.php', 'configuracaoProfile.php', 'login.php', 'registro.php'];
            ?>

            <?php if (!in_array($paginaAtual, $paginasSemLogin)): ?>
                
                <?php if ((isset($_SESSION['id'])) and (isset($_SESSION['nome'])) and (isset($_SESSION['email']))): ?>
                    <!-- Usuário Logado -->
                    <div>
                        <a class="btnLogadoPerfil-menu" href="<?php echo BASE_URL; ?>/pages/profile/profile.php">
                            <span class="mobile-text">Meu Perfil</span>
                            <img id="iconePersonBtnMenu" class="iconePerson-BtnMenuLogado" src="<?php echo BASE_URL; ?>/assets/img/icons/iconePerson.svg" alt="Perfil">
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Usuário Deslogado -->
                    <div>
                        <a class="btn-secondary1-menu" href="<?php echo BASE_URL; ?>/pages/Conta/login.php">
                            Login
                            <img id="iconePersonBtnMenu" class="iconePerson-BtnMenu" src="<?php echo BASE_URL; ?>/assets/img/icons/iconePerson.svg" alt="">
                        </a>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- Script para abrir/fechar o menu mobile -->
<script>
    function toggleMenu() {
        const menu = document.getElementById('navMenu');
        const icon = document.querySelector('.mobile-menu-icon');
        menu.classList.toggle('active');
        icon.classList.toggle('change');
    }
</script>