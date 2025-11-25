<?php
require_once __DIR__ . '/../config.php';

$mensagem = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulação de envio de email
    $mensagem = "Obrigado! Sua mensagem foi enviada. Entraremos em contato em breve.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale Conosco - SportMatch</title>
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/contato.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">


    </head>
<body class="body-contato">

    <?php include BASE_PATH . '/pages/includes/navbar.php'; ?>

    <main class="main-contato">
        <div class="container-contato">
            
            <div class="info-box">
                <h2>Fale Conosco</h2>
                <p class="desc-contato">Dúvidas sobre como alugar? Problemas com sua reserva? Entre em contato com a nossa equipe.</p>
                
                <div class="info-item">
                    <div class="icon-circle">📍</div>
                    <div>
                        <h4>Nosso Escritório</h4>
                        <p>Vila do Doce, 123 - Ribeirão Pires, SP</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-circle">📧</div>
                    <div>
                        <h4>Email</h4>
                        <p>suporte@sportmatch.com.br</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-circle">📱</div>
                    <div>
                        <h4>WhatsApp</h4>
                        <p>(11) 99999-0000</p>
                    </div>
                </div>
            </div>

            <div class="form-contato-box">
                <?php if($mensagem): ?>
                    <div class="msg-success-contato">
                        <?php echo $mensagem; ?>
                    </div>
                <?php else: ?>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Seu Nome</label>
                            <input type="text" name="nome" required placeholder="Digite seu nome completo">
                        </div>

                        <div class="form-group">
                            <label>Seu Email</label>
                            <input type="email" name="email" required placeholder="exemplo@email.com">
                        </div>

                        <div class="form-group">
                            <label>Assunto</label>
                            <select name="assunto">
                                <option value="duvida">Dúvida sobre reservas</option>
                                <option value="suporte">Problema técnico</option>
                                <option value="parceria">Sou uma Instituição</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Mensagem</label>
                            <textarea name="mensagem" rows="5" required placeholder="Escreva sua mensagem aqui..."></textarea>
                        </div>

                        <button type="submit" class="btn-enviar">ENVIAR MENSAGEM</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include BASE_PATH . '/pages/includes/footer.php'; ?>
</body>
</html>