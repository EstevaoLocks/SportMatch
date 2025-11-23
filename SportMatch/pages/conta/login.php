<?php
    require_once __DIR__ . '/../../config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SportMatch</title>
    <!-- Bootstrap para grid, mas nossos estilos .form-box vão sobrescrever as cores -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="body-form"> <!-- Classe Mestra -->

    <?php include BASE_PATH . '/pages/includes/navbar.php'; ?>

    <div class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    
                    <!-- .form-box substitui .card-custom para o tema escuro -->
                    <div class="form-box"> 
                        <div class="text-center mb-4">
                            <img src="<?php echo BASE_URL; ?>/assets/img/Logo Azul.png" alt="Logo" style="width: 50px;">
                        </div>

                        <h2>Login</h2>
                        <p class="text-center" style="color: #99A1AF; margin-bottom: 30px;">Entre para reservar ou gerenciar quadras</p>

                        <?php
                            if(isset($_SESSION['msg_login'])){
                                echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['msg_login'] . "</div>";
                                unset($_SESSION['msg_login']);
                            }
                        ?>
                        <form action="<?php echo BASE_URL; ?>/sistema/processa_login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label"><i class="far fa-envelope"></i> Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-lock"></i> Senha</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn-submit-form">Entrar</button>
                            </div>

                            <div class="text-center mt-3">
                                <span style="font-size: 0.9rem; color: #fff;">Não tem conta? <a href="registro.php" style="color: #70D4D6; font-weight: bold;">Cadastre-se</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>