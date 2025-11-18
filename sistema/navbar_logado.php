<nav class="menu-pgProfile">
    <div class="rowCima-navPgProfile">
        <div class="imgProfile-navPgProfile">
            <img id="iconeProfile-navPgProfile" class="iconeProfile-navPgProfile" src="assets/img/icons/iconePerson.svg" alt="Ícone de Perfil">
        </div>
        <div class="nomeUser-navPgProfile">
            <p>Bem vindo,</p>
            <p class="azul"><?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Usuário'; ?></p>
        </div>
    </div>

    <div class="rowBaixo-navPgProfile">
        <div class="links-pgProfileNav">
            <ul>
                <li><a class="link-pgProfileNav" href="index.php">Home</a></li>
                
                <?php if(isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'instituicao'): ?>
                    <li><a class="link-pgProfileNav" href="anuncioQuadra.php">Registrar Quadra</a></li>
                <?php else: ?>
                    <li><a class="link-pgProfileNav" href="minhas_reservas.php">Minhas Reservas</a></li>
                <?php endif; ?>

                <li><a class="link-pgProfileNav" href="categorias.php">Categorias</a></li>
                <li><a class="link-pgProfileNav" href="pertodevoce.php">Perto de você</a></li>
                <li><a class="link-pgProfileNav" href="contato.php">Contato</a></li>
            </ul>
        </div>

        <div class="links-pgProfileNav">
            <div>
                <a class="btn-secondary1-menu" href="logout.php" style="background-color: #ca5d2d; color: white;">
                    SAIR <i class="fas fa-sign-out-alt" style="margin-left:8px;"></i>
                </a>
            </div>
        </div>
    </div>
</nav>