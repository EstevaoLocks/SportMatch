<?php
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../config.php';
    include 'conexao.php';
    
    // Busca quadras e quem é o dono (instituição)
    $sql = "SELECT q.*, i.cidade as cidade_inst, m.nome_mod 
            FROM quadra q 
            JOIN instituicao i ON q.cod_instituicao = i.cod_instituicao
            JOIN quadra_mod qm ON q.cod_quadra = qm.cod_quadra
            JOIN modalidade m ON qm.cod_modalidade = m.cod_modalidade";
    $stmt = $pdo->query($sql);
    $quadras = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - SportMatch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <style> a { text-decoration: none; } </style>
</head>
<body style="background-color: #F9FAFB;">

    <?php
        include BASE_PATH . '/pages/includes/navbar.php';
    ?>

    <div class="container py-5 mt-5">
        <h2 class="text-start mb-4" style="border-left: 5px solid #F4743B; padding-left: 15px; color: #0F2F51;">Encontre sua Quadra</h2>
        
        <div class="row mb-4">
            <div class="col-md-12">
                <form action="" method="GET" class="d-flex gap-2">
                    <input type="text" class="form-control" placeholder="Buscar por nome, esporte ou cidade...">
                    <button class="btn-primary2" style="margin:0; padding: 10px 30px;">Filtrar</button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach($quadras as $q): ?>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; overflow: hidden;">
                    <img src="assets/img/quadra-fut.png" class="card-img-top" alt="Quadra" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-info text-dark"><?php echo $q['nome_mod']; ?></span>
                            <span class="badge bg-secondary"><?php echo $q['cidade_inst']; ?></span>
                        </div>
                        <h5 class="card-title fw-bold" style="color: #0F2F51;"><?php echo $q['nome_quadra']; ?></h5>
                        <p class="card-text text-muted small">
                            <?php echo $q['composicao']; ?> | <?php echo $q['tamanho']; ?>
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-success">R$ <?php echo number_format($q['valor_hora'], 2, ',', '.'); ?>/h</span>
                            <a href="detalhes_quadra.php?id=<?php echo $q['cod_quadra']; ?>" class="btn-custom-dark btn-sm px-4">Ver Detalhes</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
    </body>

    <?php
        include BASE_PATH . '/pages/includes/footer.php';
    ?>
</html>