<?php
require_once __DIR__ . '/../../config.php';
?>

<!-- Menu Perfil -->
<nav class="menu-pgProfile">
    <!-- parte superior -->
    <div class="rowCima-navPgProfile">
        <div class="leftContentRowCima-navPgProfile">
            <div class="imgProfile-navPgProfile">
                <img id="iconeProfile-navPgProfile" class="iconeProfile-navPgProfile" src="<?php echo BASE_URL; ?>/assets/img/icons/iconePerfil.svg" alt="Ícone de perfil">
            </div>
            <div class="nomeUser-navPgProfile">
                <p>Bem vindo,</p>
                <p class="azul">
                    <?php
                    require BASE_PATH . '/sistema/conexao.php';
                    if(isset($_SESSION['email'])) {
                        $sql = "SELECT nome FROM usuario WHERE email = :email";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':email', $_SESSION['email']);
                        $stmt->execute();
                        while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo htmlspecialchars($usuario['nome']);
                        }
                    }
                    ?>
                </p>
            </div>
        </div>

        <div class="rightContentRowCima-navPgProfile">
            <?php if (basename($_SERVER['PHP_SELF']) == 'configuracaoProfile.php'): ?>
                <div class="containerIconeConfig-navPgProfile">
                    <a class="linkIconeConfig-navPgProfile" href="<?php echo BASE_URL; ?>/pages/profile/profile.php">
                        <svg class="iconeSeta-navPgProfile" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" style="width: 20px; height: 20px; fill: #ccc;">
                            <path d="M566.6 342.6C579.1 330.1 579.1 309.8 566.6 297.3L406.6 137.3C394.1 124.8 373.8 124.8 361.3 137.3C348.8 149.8 348.8 170.1 361.3 182.6L466.7 288L96 288C78.3 288 64 302.3 64 320C64 337.7 78.3 352 96 352L466.7 352L361.3 457.4C348.8 469.9 348.8 490.2 361.3 502.7C373.8 515.2 394.1 515.2 406.6 502.7L566.6 342.7z" />
                        </svg>
                    </a>
                </div>
            <?php else: ?>
                <div class="containerIconeConfig-navPgProfile">
                    <a class="linkIconeConfig-navPgProfile" href="<?php echo BASE_URL; ?>/pages/profile/configuracaoProfile.php">
                        <img id="iconeConfig-navPgProfile" class="iconeConfig-navPgProfile" src="<?php echo BASE_URL; ?>/assets/img/icons/iconeConfiguracao.svg" alt="Configurar">
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- parte inferior (Links Scrolláveis no Mobile) -->
    <div class="rowBaixo-navPgProfile">
        <ul class="links-pgProfileNav">
            <li class="liLink-pgProfileNav <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
                <a class="link-pgProfileNav" href="<?php echo BASE_URL; ?>/pages/profile/profile.php">Perfil</a>
            </li>
            <li class="liLink-pgProfileNav <?php echo basename($_SERVER['PHP_SELF']) == 'quadrasReservadas.php' ? 'active' : ''; ?>">
                <a class="link-pgProfileNav" href="<?php echo BASE_URL; ?>/pages/profile/quadrasReservadas.php">Reservas</a>
            </li>
            <li class="liLink-pgProfileNav <?php echo basename($_SERVER['PHP_SELF']) == 'quadras_favoritadas.php' ? 'active' : ''; ?>">
                <a class="link-pgProfileNav" href="<?php echo BASE_URL; ?>/pages/profile/quadras_favoritadas.php">Favoritos</a>
            </li>
        </ul>
    </div>
</nav>