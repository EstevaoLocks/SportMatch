<?php
// Verifica se a sessão já foi iniciada, se não, inicia.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// LÓGICA DO SISTEMA:
// Se existir um 'id' na sessão, significa que o usuário está logado.
if (isset($_SESSION['id']) && isset($_SESSION['nome'])) {
    
    // 1. CARREGA A BARRA DE LOGADO
    include 'navbar_logado.php';

} else {
    
    // 2. CARREGA A BARRA PADRÃO (VISITANTE)
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
            <div>
                <a class="btn-secondary1-menu" href="login.php">Login<img id="iconePersonBtnMenu" class="iconePerson-BtnMenu" src="assets/img/icons/iconePerson.svg" alt=""></a>
            </div>
            <div>
                <a class="btn-primary2-menu" href="registro.php">Cadastro<img id="iconePersonBtnMenu" class="iconePerson-BtnMenu" src="assets/img/icons/iconePersonCad.png" alt=""></a>
            </div>
        </div>
    </nav>
<?php 
} // Fecha o else 
?>