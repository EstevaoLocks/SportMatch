<?php
    require_once __DIR__ . '/../../config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - SportMatch</title>
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
                <div class="col-lg-10">
                    
                    <div class="form-box"> <!-- Card Escuro Padronizado -->
                        <h2>Criar Conta</h2>
                        
                        <form action="<?php echo BASE_URL; ?>/processa_registro.php" method="POST">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label class="form-label fw-bold">Eu quero:</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_cadastro" id="tipoUsuario" value="usuario" checked onclick="toggleForm('usuario')">
                                            <label class="form-check-label" for="tipoUsuario" style="color: #fff;">Reservar Quadras (Atleta)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_cadastro" id="tipoInstituicao" value="instituicao" onclick="toggleForm('instituicao')">
                                            <label class="form-check-label" for="tipoInstituicao" style="color: #fff;">Alugar Minhas Quadras (Instituição)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nome Completo / Razão Social</label>
                                    <input type="text" name="nome" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Senha</label>
                                    <input type="password" name="senha" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telefone</label>
                                    <input type="text" name="telefone" class="form-control" required>
                                </div>

                                <div class="col-12 mt-3"><h5 class="text-muted border-bottom pb-2">Endereço</h5></div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">CEP</label>
                                    <input type="text" name="cep" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Estado</label>
                                    <input type="text" name="estado" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" name="cidade" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Bairro</label>
                                    <input type="text" name="bairro" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rua</label>
                                    <input type="text" name="rua" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Número</label>
                                    <input type="number" name="numero" class="form-control" required>
                                </div>

                                <div id="campos-usuario" class="row p-0 m-0">
                                    <div class="col-12 mt-3"><h5 class="text-muted border-bottom pb-2">Dados Pessoais</h5></div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">CPF</label>
                                        <input type="text" name="cpf" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">RG</label>
                                        <input type="text" name="rg" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Data de Nascimento</label>
                                        <input type="date" name="datanasc" class="form-control">
                                    </div>
                                </div>

                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="btn-submit-form">Finalizar Cadastro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleForm(tipo) {
            const camposUser = document.getElementById('campos-usuario');
            if (tipo === 'instituicao') {
                camposUser.style.display = 'none';
            } else {
                camposUser.style.display = 'flex';
            }
        }
    </script>
</body>
</html>