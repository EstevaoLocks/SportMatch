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
        <?php
        if ($is_profilePg != true) {

            if ((isset($_SESSION['id'])) and (isset($_SESSION['nome'])) and (isset($_SESSION['email']))) {
                echo '
                    <div>
                        <a class="btnLogadoPerfil-menu" href="profile.php"><img id="iconePersonBtnMenu" class="iconePerson-BtnMenuLogado" src="assets/img/icons/iconePerson.svg" alt=""></a>
                    </div>
                ';
            } else {
                echo '
                    <div>
                        <a class="btn-secondary1-menu" href="login.php">Login<img id="iconePersonBtnMenu" class="iconePerson-BtnMenu" src="assets/img/icons/iconePerson.svg" alt=""></a>
                    </div>
                ';
            }
        }

        ?>
    </div>

</nav>