<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportMatch - Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-map-marked-alt fa-lg text-light me-2"></i>
                <div class="d-inline-block">
                    <span>SportMatch</span>
                    <small>Brasil</small>
                </div>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Perto de você</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Por que escolher</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contato</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10"> 
                    <div class="card-custom pb-5">
                        
                        <div class="profile-header">
                            <div class="avatar-circle">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="profile-welcome">
                                <h2>Bem-vindo!</h2>
                                <p>Este é o seu perfil</p>
                            </div>
                        </div>

                        <form class="px-md-4">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><i class="far fa-user"></i> Nome</label>
                                        <input type="text" class="form-control profile-input" value="<?php echo $nome_usuario ?? 'Fulano de Tal'; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Sua localização:</label>
                                        <input type="text" class="form-control profile-input" value="<?php echo $endereco_usuario ?? 'Rua Tal, 36, Bairro de Tal, SP'; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><i class="far fa-envelope"></i> Email</label>
                                        <input type="email" class="form-control profile-input" value="<?php echo $email_usuario ?? 'Fulano@gmail.com'; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-lock"></i> Senha</label>
                                        <input type="password" class="form-control profile-input" value="123456789" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-actions px-2">
                                <a href="#" id="editProfileLink" class="profile-link">
                                    <i class="fas fa-pen me-2"></i> Editar Informações pessoais
                                </a>
                                
                                <a href="login.php" class="exit-link">
                                    Exit <i class="far fa-times-circle ms-1"></i>
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-map-marked-alt fa-2x text-light me-2"></i>
                        <div>
                            <h5 class="mb-0">SportMatch</h5>
                            <small style="color: var(--btn-teal);">Brasil</small>
                        </div>
                    </div>
                    <p class="mt-2">Encontre uma quadra em qualquer lugar</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Quick Links</h5>
                    <ul><li><a href="#">Home</a></li><li><a href="#">Book a Ride</a></li><li><a href="#">Fleet</a></li><li><a href="#">Pricing</a></li></ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Services</h5>
                    <ul><li><a href="#">Corporate Accounts</a></li><li><a href="#">Become a Driver</a></li><li><a href="#">Airport Transfer</a></li><li><a href="#">Event Services</a></li></ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Contact Us</h5>
                    <ul class="footer-contact">
                        <li><i class="fas fa-phone-alt"></i> 1-800-SPORT-MATCH</li>
                        <li><i class="far fa-envelope"></i> contato@sportmatch.com</li>
                        <li><i class="fas fa-map-marker-alt"></i> Em todos os estados do Brasil</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>