<?php
    require_once __DIR__ . '/../config.php';
    require_once __DIR__ . '/conexao.php';

    // Filtros
    $filtroModalidade = isset($_GET['modalidade']) ? $_GET['modalidade'] : '';
    $termoBusca = isset($_GET['busca']) ? $_GET['busca'] : '';

    // Busca Modalidades
    try {
        $stmtModalidades = $pdo->query("SELECT * FROM modalidade ORDER BY nome_mod");
        $modalidades = $stmtModalidades->fetchAll();
    } catch (PDOException $e) { $modalidades = []; }

    // Query Principal
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
    $sql .= " GROUP BY q.cod_quadra ORDER BY q.cod_quadra DESC";

    try {
        $stmtQuadras = $pdo->prepare($sql);
        $stmtQuadras->execute($params);
        $quadras = $stmtQuadras->fetchAll();
    } catch (PDOException $e) { $quadras = []; }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Quadras - SportMatch</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/categorias.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <a href="?" class="btn-limpar"><i class="fas fa-times"></i> Limpar Filtros</a>
                <?php endif; ?>
            </form>
        </section>

        <section class="resultadosBusca">
            <div class="quadrasContainer">
                <?php if (count($quadras) > 0): ?>
                    <?php foreach ($quadras as $quadra): ?>
                        <?php 
                            // Lógica de Imagem Multi-pasta
                            $imgSrc = BASE_URL . '/assets/img/quadra-fut.png';
                            if (!empty($quadra['imagem'])) {
                                $nomeImg = $quadra['imagem'];
                                $pathQuadras = BASE_PATH . '/assets/img/quadras/' . $nomeImg;
                                $pathLugares = BASE_PATH . '/assets/img/' . $nomeImg;
                                $pathGeral = BASE_PATH . '/assets/img/' . $nomeImg;

                                if (file_exists($pathQuadras)) $imgSrc = BASE_URL . '/assets/img/quadras/' . $nomeImg;
                                elseif (file_exists($pathLugares)) $imgSrc = BASE_URL . '/assets/img/' . $nomeImg;
                                elseif (file_exists($pathGeral)) $imgSrc = BASE_URL . '/assets/img/' . $nomeImg;
                            }
                        ?>

                        <div class="cardQuadra">
                            <div class="cardImageContainer">
                                <img src="<?php echo $imgSrc; ?>" alt="Foto da <?php echo $quadra['nome_quadra']; ?>" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/quadra-fut.png'">
                            </div>
                            
                            <div class="infoQuadra">
                                <h3 class="tituloQuadra"><?php echo htmlspecialchars($quadra['nome_quadra']); ?></h3>
                                <p class="localQuadra"><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($quadra['bairro']); ?></p>
                                <div class="detalhesQuadra">
                                    <p><span>Esporte:</span> <?php echo htmlspecialchars($quadra['nome_mod']); ?></p>
                                    <p><span>Tamanho:</span> <?php echo htmlspecialchars($quadra['tamanho']); ?></p>
                                </div>
                                <p class="precoQuadra">R$ <?php echo number_format($quadra['valor_hora'], 2, ',', '.'); ?>/h</p>
                                <a href="produto.php?id=<?php echo $quadra['cod_quadra']; ?>" class="btnReservar">Veja mais</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="mensagemSemQuadra"><p>Nenhuma quadra encontrada com esses filtros.</p></div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <?php include BASE_PATH . '/pages/includes/footer.php'; ?>
</body>
</html>