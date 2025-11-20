<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SportMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="cadastro"> <?php include 'navbar.php'; ?>

    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card-custom">
                        <div class="top-right-icon text-center">
                            <img src="assets/img/Logo Azul.png" alt="Logo" style="width: 50px;">
                        </div>

                        <h2 class="card-title">Login</h2>
                        <p class="card-subtitle">Entre para reservar ou gerenciar quadras</p>

                        <?php
                            // A sessão já foi iniciada no navbar.php
                            if(isset($_SESSION['msg_login'])){
                                echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['msg_login'] . "</div>";
                                unset($_SESSION['msg_login']); // Limpa a mensagem após exibir
                            }
                        ?>
                        <form action="processa_login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label"><i class="far fa-envelope"></i> Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-lock"></i> Senha</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn-custom-teal">Entrar</button>
                            </div>

                            <div class="text-center mt-3">
                                <span style="font-size: 0.9rem; color: #555;">Não tem conta? <a href="registro.php" style="color: var(--btn-dark-blue);">Cadastre-se</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </body>
</html>