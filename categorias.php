<?php
    require_once __DIR__ . '/config.php';
    require_once __DIR__ . '/conexao.php';

    // 1. Buscar modalidades para o filtro
    try {
        $stmtModalidades = $pdo->query("SELECT * FROM modalidade ORDER BY nome_mod");
        $modalidades = $stmtModalidades->fetchAll();
    } catch (PDOException $e) {
        $modalidades = [];
    }

    // 2. Lógica de Filtro
    $filtroModalidade = isset($_GET['modalidade']) ? $_GET['modalidade'] : '';
    $termoBusca = isset($_GET['busca']) ? $_GET['busca'] : '';

    // 3. Query de Quadras
    $sql = "SELECT DISTINCT q.*, m.nome_mod 
            FROM quadra q
            JOIN quadra_mod qm ON q.cod_quadra = qm.cod_quadra
            JOIN modalidade m ON qm.cod_modalidade = m.cod_modalidade
            WHERE 1=1";

    $params = [];

    if (!empty($filtroModalidade)) {
        $sql .= " AND m.cod_modalidade = :cod_mod";
        $params[':cod_mod'] = $filtroModalidade;
    }

    if (!empty($termoBusca)) {
        $sql .= " AND (q.nome_quadra LIKE :busca OR q.cidade LIKE :busca)";
        $params[':busca'] = "%$termoBusca%";
    }

    $sql .= " GROUP BY q.cod_quadra ORDER BY q.cod_quadra DESC"; // Ordena por mais recente

    try {
        $stmtQuadras = $pdo->prepare($sql);
        $stmtQuadras->execute($params);
        $quadras = $stmtQuadras->fetchAll();
    } catch (PDOException $e) {
        $quadras = [];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS Geral -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style_quadras.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Buscar Quadras - SportMatch</title>

    <style>
        /* CSS Inline para garantir o botão limpar */
        .btn-limpar {
            display: inline-flex; align-items: center; justify-content: center;
            height: 50px; padding: 0 25px; background-color: transparent;
            border: 1px solid #70D4D6; border-radius: 8px; color: #70D4D6;
            font-weight: 600; font-size: 0.95rem; text-decoration: none; transition: 0.3s; margin-left: 10px;
        }
        .btn-limpar:hover { background-color: #70D4D6; color: #02050A; box-shadow: 0 0 10px rgba(112, 212, 214, 0.3); }
        .formFiltro { display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 15px; }
        @media (max-width: 768px) { .btn-limpar { width: 100%; margin-left: 0; margin-top: 10px; } }
    </style>
</head>
<body class="body-pgQuadras">

    <?php include BASE_PATH . '/pages/includes/navbar.php'; ?>

    <main class="main-pgQuadras">
        
        <section class="sectionBusca">
            <h2>Encontre sua quadra ideal</h2>
            
            <form method="GET" action="" class="formFiltro">
                <div class="input-wrapper">
                    <input type="text" name="busca" class="form-control-busca" placeholder="Nome da quadra ou cidade..." value="<?php echo htmlspecialchars($termoBusca); ?>">
                </div>

                <div class="select-wrapper">
                    <select name="modalidade" class="form-select-busca" onchange="this.form.submit()">
                        <option value="">Todos os Esportes</option>
                        <?php foreach ($modalidades as $mod): ?>
                            <option value="<?php echo $mod['cod_modalidade']; ?>" <?php echo ($filtroModalidade == $mod['cod_modalidade']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($mod['nome_mod']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <?php if(!empty($filtroModalidade) || !empty($termoBusca)): ?>
                    <a href="?" class="btn-limpar"><i class="fas fa-times" style="margin-right: 8px;"></i> Limpar Filtros</a>
                <?php endif; ?>
            </form>
        </section>

        <section class="resultadosBusca">
            <div class="quadrasContainer">
                
                <?php if (count($quadras) > 0): ?>
                    <?php foreach ($quadras as $quadra): ?>
                        <?php 
                            // Lógica de Imagem: Verifica se existe imagem cadastrada no banco
                            if (!empty($quadra['imagem'])) {
                                $imgSrc = BASE_URL . '/assets/img/quadras/' . $quadra['imagem'];
                            } else {
                                // Fallback para placeholders se não tiver imagem customizada
                                $imgSrc = BASE_URL . '/assets/img/quadra-fut.png'; 
                                $nomeMod = strtolower($quadra['nome_mod']);
                                
                                if (strpos($nomeMod, 'basquete') !== false) {
                                    $imgSrc = BASE_URL . '/assets/img/quadraBaquete 1.png';
                                } elseif (strpos($nomeMod, 'vôlei') !== false || strpos($nomeMod, 'volei') !== false) {
                                    $imgSrc = BASE_URL . '/assets/img/quadra-de-volei4 1.png';
                                } elseif (strpos($nomeMod, 'tênis') !== false) {
                                    $imgSrc = BASE_URL . '/assets/img/quadraTenis.png';
                                }
                            }
                        ?>

                        <div class="cardQuadra">
                            <div class="cardImageContainer">
                                <!-- onerror: garante que se a imagem quebrar, mostra um padrão -->
                                <img src="<?php echo $imgSrc; ?>" alt="Foto da <?php echo $quadra['nome_quadra']; ?>" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/quadra-fut.png'">
                            </div>
                            
                            <div class="infoQuadra">
                                <h3 class="tituloQuadra"><?php echo htmlspecialchars($quadra['nome_quadra']); ?></h3>
                                
                                <p class="localQuadra">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <?php echo htmlspecialchars($quadra['rua'] . ', ' . $quadra['numero']); ?>
                                </p>
                                <p class="localQuadraDetalhe">
                                    <?php echo htmlspecialchars($quadra['bairro'] . ' - ' . $quadra['cidade'] . '/' . $quadra['estado']); ?>
                                </p>

                                <div class="containerStars">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>

                                <div class="detalhesQuadra">
                                    <p><span>Esporte:</span> <?php echo htmlspecialchars($quadra['nome_mod']); ?></p>
                                    <p><span>Tamanho:</span> <?php echo htmlspecialchars($quadra['tamanho']); ?></p>
                                    <p><span>Piso:</span> <?php echo htmlspecialchars($quadra['composicao']); ?></p>
                                </div>

                                <p class="precoQuadra">R$ <?php echo number_format($quadra['valor_hora'], 2, ',', '.'); ?>/h</p>

                                <a href="detalhes_quadra.php?id=<?php echo $quadra['cod_quadra']; ?>" class="btnReservar">Veja mais</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="mensagemSemQuadra">
                        <p>Nenhuma quadra encontrada com esses filtros.</p>
                    </div>
                <?php endif; ?>

            </div>
        </section>

    </main>

    <?php include BASE_PATH . '/pages/includes/footer.php'; ?>
    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>