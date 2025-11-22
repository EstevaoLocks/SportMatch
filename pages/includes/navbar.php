<?php 
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../../config.php';
?>

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
            <li><a href="registro.php">Registrar</a></li>
            <li><a href="categorias.php">Categorias</a></li>
            <li><a href="pertodevoce.php">Perto de você</a></li>
            <li><a href="sobre.php">Por que escolher?</a></li>
            <li><a href="contato.php">Contato</a></li>
        </ul>
    </div>

    <div class="links">
        <?php if (basename($_SERVER['PHP_SELF']) != 'profile.php' && basename($_SERVER['PHP_SELF']) != 'quadrasReservadas.php' && basename($_SERVER['PHP_SELF']) != 'favoritos.php' && basename($_SERVER['PHP_SELF']) != 'configuracaoProfile.php'): ?>
            <?php if ((isset($_SESSION['id'])) and (isset($_SESSION['nome'])) and (isset($_SESSION['email']))): ?>
                <div>
                    <a class="btnLogadoPerfil-menu" href="profile.php"><img id="iconePersonBtnMenu" class="iconePerson-BtnMenuLogado" src="assets/img/icons/iconePerson.svg" alt=""></a>
                </div>
            <?php else: ?>
                <div>
                    <a class="btn-secondary1-menu" href="login.php">Login<img id="iconePersonBtnMenu" class="iconePerson-BtnMenu" src="assets/img/icons/iconePerson.svg" alt=""></a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</nav>