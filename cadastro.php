<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportMatch - Cadastro</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-map-marked-alt fa-lg text-light me-2"></i>
                <div class="d-inline-block">
                    <span>SportMatch</span>
                    <small>Brasil</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                    <div class="card-custom">
                        <div class="top-right-icon text-center imglogo">
                            <img src="assets/img/SportMatch.png" alt="sportmatch">
                        </div>

                        <h2 class="card-title">Bem-vindo!</h2>
                        <p class="card-subtitle">Por favor, insira suas credenciais</p>

                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><i class="far fa-user"></i> Nome</label>
                                        <input type="text" class="form-control" placeholder="Seu nome" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-user-tag"></i> Você quer...</label>
                                        <div class="radio-group mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="userType" id="typeOwner">
                                                <label class="form-check-label" for="typeOwner">Cadastrar/alugar a sua(s) quadras</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="userType" id="typeUser" checked>
                                                <label class="form-check-label" for="typeUser">Reservar quadras</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label"><i class="far fa-envelope"></i> Email</label>
                                        <input type="email" class="form-control" placeholder="Seu email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-lock"></i> Senha</label>
                                        <input type="password" class="form-control" placeholder="**********" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn-custom-dark">Criar conta</button>
                            </div>

                            <div class="text-center mt-3 mb-3">
                                <span style="font-size: 0.9rem; color: #555;">Já tem uma conta? Por que você não tenta <a href="login.php" style="color: var(--btn-teal);">Entrar</a>?</span>
                            </div>
                            
                            <hr class="my-4">

                            <div>
                                <button type="button" class="btn-google">
                                    <img src="assets/img/logogoogle.png" alt="Google" width="20">
                                    Sign in with Google
                                </button>
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
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Book a Ride</a></li> <li><a href="#">Fleet</a></li>
                        <li><a href="#">Pricing</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Services</h5>
                    <ul>
                        <li><a href="#">Corporate Accounts</a></li>
                        <li><a href="#">Become a Driver</a></li>
                        <li><a href="#">Airport Transfer</a></li>
                        <li><a href="#">Event Services</a></li>
                    </ul>
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