<?php
    require_once __DIR__ . '/../sitema/classes/config.php';
    require_once __DIR__ . '/../sitema/classes/conexao.php';

    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_GET['id'])) {
        header("Location: categorias.php");
        exit;
    }

    $idQuadra = $_GET['id'];
    $userId = $_SESSION['id'] ?? null;
    $userType = $_SESSION['tipo_usuario'] ?? null;

    // --- PROCESSAMENTO DE RESERVA/CANCELAMENTO ---
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userId) {
        if (isset($_POST['acao']) && $_POST['acao'] === 'reservar') {
            $data = $_POST['data'];
            $hora = $_POST['hora']; 
            $valor = $_POST['valor'];
            $dataHoraReserva = $data . ' ' . $hora . ':00';

            try {
                $check = $pdo->prepare("SELECT * FROM reserva WHERE cod_quadra = ? AND data_reserva = ? AND horario_reserva = ?");
                $check->execute([$idQuadra, $data, $dataHoraReserva]);
                
                if ($check->rowCount() == 0) {
                    $sql = "INSERT INTO reserva (duracao, valor, data_reserva, horario_reserva, cod_quadra, cod_usuario) 
                            VALUES (1.0, :valor, :data, :dataHora, :quadra, :usuario)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':valor' => $valor, ':data' => $data, ':dataHora' => $dataHoraReserva, ':quadra' => $idQuadra, ':usuario' => $userId]);
                    $msg = "<div class='alert success'>Reserva realizada com sucesso!</div>";
                } else {
                    $msg = "<div class='alert error'>Horário já reservado.</div>";
                }
            } catch (Exception $e) {
                $msg = "<div class='alert error'>Erro: " . $e->getMessage() . "</div>";
            }
        }
        if (isset($_POST['acao']) && $_POST['acao'] === 'cancelar') {
            $idReserva = $_POST['id_reserva'];
            try {
                if ($userType === 'instituicao') {
                    $pdo->prepare("DELETE FROM reserva WHERE cod_reserva = ?")->execute([$idReserva]);
                } else {
                    $pdo->prepare("DELETE FROM reserva WHERE cod_reserva = ? AND cod_usuario = ?")->execute([$idReserva, $userId]);
                }
                $msg = "<div class='alert success'>Reserva cancelada.</div>";
            } catch (Exception $e) { $msg = "<div class='alert error'>Erro ao cancelar.</div>"; }
        }
    }

    // --- BUSCAR DADOS DA QUADRA ---
    $stmt = $pdo->prepare("SELECT q.*, i.nome as nome_inst, m.nome_mod 
                           FROM quadra q 
                           JOIN instituicao i ON q.cod_instituicao = i.cod_instituicao
                           JOIN quadra_mod qm ON q.cod_quadra = qm.cod_quadra
                           JOIN modalidade m ON qm.cod_modalidade = m.cod_modalidade
                           WHERE q.cod_quadra = ?");
    $stmt->execute([$idQuadra]);
    $quadra = $stmt->fetch();

    if (!$quadra) { echo "Quadra não encontrada."; exit; }

    // Lógica Agenda
    $dataSelecionada = $_GET['data'] ?? date('Y-m-d');
    $stmtRes = $pdo->prepare("SELECT * FROM reserva WHERE cod_quadra = ? AND data_reserva = ?");
    $stmtRes->execute([$idQuadra, $dataSelecionada]);
    $reservasDoDia = $stmtRes->fetchAll(PDO::FETCH_ASSOC);
    $horariosOcupados = [];
    foreach ($reservasDoDia as $res) {
        $hora = date('H', strtotime($res['horario_reserva']));
        $horariosOcupados[$hora] = ['id_reserva' => $res['cod_reserva'], 'cod_usuario' => $res['cod_usuario']];
    }
    $horariosDisponiveis = range(8, 22); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($quadra['nome_quadra']); ?> - SportMatch</title>
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/produto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>.alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; text-align: center; font-weight: bold; } .success { background-color: #d4edda; color: #155724; } .error { background-color: #f8d7da; color: #721c24; }</style>
</head>
<body>

    <?php include BASE_PATH . '/pages/includes/navbar.php'; ?>

    <main class="main-produto">
        <div class="produto-container">
            
            <!-- IMAGEM COM VERIFICAÇÃO MULTI-PASTA (CORRIGIDO) -->
            <div class="produto-imagem">
                <?php 
                    $imgUrl = BASE_URL . '/assets/img/quadra-fut.png'; // Placeholder padrão

                    if (!empty($quadra['imagem'])) {
                        $nomeImg = $quadra['imagem'];
                        
                        // Caminhos físicos para verificação
                        $pathQuadras = BASE_PATH . '/assets/img/quadras/' . $nomeImg;
                        $pathLugares = BASE_PATH . '/assets/img/' . $nomeImg; // NOVA PASTA
                        $pathGeral   = BASE_PATH . '/assets/img/' . $nomeImg;

                        if (file_exists($pathQuadras)) {
                            $imgUrl = BASE_URL . '/assets/img/quadras/' . $nomeImg;
                        } elseif (file_exists($pathLugares)) {
                            $imgUrl = BASE_URL . '/assets/img/' . $nomeImg;
                        } elseif (file_exists($pathGeral)) {
                            $imgUrl = BASE_URL . '/assets/img/' . $nomeImg;
                        }
                    }
                ?>
                <img src="<?php echo $imgUrl; ?>" alt="Foto da Quadra" onerror="this.src='<?php echo BASE_URL; ?>/assets/img/Logo Azul.png'">
            </div>

            <div class="produto-info">
                <?php echo $msg; ?>
                <h1><?php echo htmlspecialchars($quadra['nome_quadra']); ?></h1>
                <div class="produto-local"><i class="fas fa-map-marker-alt"></i> <span><?php echo htmlspecialchars($quadra['bairro'] . ', ' . $quadra['cidade'] . ' - ' . $quadra['estado']); ?></span></div>
                <div class="produto-descricao">
                    <p><strong>Esporte:</strong> <?php echo htmlspecialchars($quadra['nome_mod']); ?></p>
                    <p style="margin-top: 10px;">Quadra com piso de <?php echo htmlspecialchars($quadra['composicao']); ?>. Gerenciada por <strong><?php echo htmlspecialchars($quadra['nome_inst']); ?></strong>.</p>
                </div>
                <div class="specs-grid">
                    <div class="spec-item"><i class="fas fa-ruler-combined"></i><span><?php echo htmlspecialchars($quadra['tamanho']); ?></span></div>
                    <div class="spec-item"><i class="fas fa-umbrella"></i><span><?php echo $quadra['cobertura'] ? 'Coberta' : 'Descoberta'; ?></span></div>
                    <div class="spec-item"><i class="fas fa-users"></i><span><?php echo $quadra['arquibancada'] ? 'Com Arquibancada' : 'Sem Arquibancada'; ?></span></div>
                </div>
                <div class="produto-preco">R$ <?php echo number_format($quadra['valor_hora'], 2, ',', '.'); ?> <small>/hora</small></div>

                <section class="agenda-section">
                    <div class="agenda-header">
                        <h3><i class="far fa-calendar-alt"></i> Disponibilidade</h3>
                        <form method="GET" class="data-selector">
                            <input type="hidden" name="id" value="<?php echo $idQuadra; ?>">
                            <input type="date" name="data" class="input-data" value="<?php echo $dataSelecionada; ?>" min="<?php echo date('Y-m-d'); ?>">
                            <button type="submit" class="btn-buscar-data">Ver</button>
                        </form>
                    </div>
                    <?php if (!$userId): ?>
                        <div class="alert error" style="margin: 0;">Faça login para reservar.</div>
                    <?php else: ?>
                        <div class="horarios-grid">
                            <?php foreach ($horariosDisponiveis as $hora): ?>
                                <?php 
                                    $horaFormatada = str_pad($hora, 2, '0', STR_PAD_LEFT) . ":00";
                                    $horaSimples = str_pad($hora, 2, '0', STR_PAD_LEFT);
                                    $ocupado = isset($horariosOcupados[$horaSimples]);
                                    $meuTicket = false;
                                    if ($ocupado) {
                                        if (($userType === 'usuario' && $horariosOcupados[$horaSimples]['cod_usuario'] == $userId) || ($userType === 'instituicao' && $quadra['cod_instituicao'] == $userId)) {
                                            $meuTicket = true;
                                        }
                                    }
                                ?>
                                <?php if (!$ocupado): ?>
                                    <form method="POST" onsubmit="return confirm('Confirmar reserva para <?php echo $horaFormatada; ?>?');">
                                        <input type="hidden" name="acao" value="reservar"><input type="hidden" name="data" value="<?php echo $dataSelecionada; ?>"><input type="hidden" name="hora" value="<?php echo $horaFormatada; ?>"><input type="hidden" name="valor" value="<?php echo $quadra['valor_hora']; ?>">
                                        <button type="submit" class="ticket-hora livre" style="width:100%;"><span><?php echo $horaFormatada; ?></span><small>R$ <?php echo number_format($quadra['valor_hora'], 0); ?></small></button>
                                    </form>
                                <?php elseif ($meuTicket): ?>
                                    <form method="POST" onsubmit="return confirm('Deseja cancelar esta reserva?');">
                                        <input type="hidden" name="acao" value="cancelar"><input type="hidden" name="id_reserva" value="<?php echo $horariosOcupados[$horaSimples]['id_reserva']; ?>">
                                        <button type="submit" class="ticket-hora meu-ticket" style="width:100%;" title="Clique para Cancelar"><span><?php echo $horaFormatada; ?></span><small><i class="fas fa-times-circle"></i> Cancelar</small></button>
                                    </form>
                                <?php else: ?>
                                    <div class="ticket-hora reservado"><span><?php echo $horaFormatada; ?></span><small>Reservado</small></div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </section>
            </div>
        </div>
    </main>
    <?php include BASE_PATH . '/pages/includes/footer.php'; ?>
</body>
</html>