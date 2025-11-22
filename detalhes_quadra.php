<?php
    session_start();
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../config.php';
    
    include 'conexao.php';

    if(!isset($_GET['id'])){ header('Location: categorias.php'); exit; }
    $id_quadra = $_GET['id'];

    // Busca detalhes da quadra
    $sql = "SELECT q.*, i.nome as nome_inst, i.rua, i.numero, i.bairro, i.cidade, i.estado 
            FROM quadra q 
            JOIN instituicao i ON q.cod_instituicao = i.cod_instituicao
            WHERE q.cod_quadra = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_quadra);
    $stmt->execute();
    $quadra = $stmt->fetch(PDO::FETCH_ASSOC);

    // Processamento do Agendamento
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agendar'])){
        if(!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'usuario'){
            echo "<script>alert('Você precisa estar logado como USUÁRIO para agendar!'); window.location='login.php';</script>";
        } else {
            $data = $_POST['data'];
            $hora = $_POST['hora'];
            $duracao = $_POST['duracao'];
            // Calcula valor total
            $valor_total = $quadra['valor_hora'] * $duracao;
            $data_hora_formatada = $data . ' ' . $hora . ':00';

            $sqlInsert = "INSERT INTO reserva (duracao, valor, data_reserva, horario_reserva, cod_quadra, cod_usuario, status) 
                          VALUES (:duracao, :valor, :data, :hora, :quadra, :usuario, 'Pendente')";
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->execute([
                ':duracao' => $duracao,
                ':valor' => $valor_total,
                ':data' => $data,
                ':hora' => $data_hora_formatada,
                ':quadra' => $id_quadra,
                ':usuario' => $_SESSION['id']
            ]);

            echo "<script>alert('Solicitação de agendamento enviada! Aguarde aprovação.'); window.location='minhas_reservas.php';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $quadra['nome_quadra']; ?> - Detalhes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style> a { text-decoration: none; } </style>
</head>
<body style="background-color: #02050A; color: white;"> <?php include 'navbar.php'; ?>

    <div class="container py-5 mt-5">
        <div class="row">
            <div class="col-lg-7">
                <div class="card bg-dark text-white border-secondary mb-4">
                    <img src="assets/img/estadioFutebol.png" class="card-img-top" alt="Imagem Quadra" style="opacity: 0.8;">
                    <div class="card-body">
                        <h2 class="card-title text-info"><?php echo $quadra['nome_quadra']; ?></h2>
                        <p class="text-muted"><i class="fas fa-map-marker-alt"></i> 
                            <?php echo "{$quadra['rua']}, {$quadra['numero']} - {$quadra['bairro']}, {$quadra['cidade']}-{$quadra['estado']}"; ?>
                        </p>
                        
                        <hr class="border-secondary">
                        
                        <h5>Detalhes Técnicos</h5>
                        <ul class="list-unstyled">
                            <li><strong>Tamanho:</strong> <?php echo $quadra['tamanho']; ?></li>
                            <li><strong>Piso:</strong> <?php echo $quadra['composicao']; ?></li>
                            <li><strong>Cobertura:</strong> <?php echo $quadra['cobertura'] ? 'Sim' : 'Não'; ?></li>
                            <li><strong>Arquibancada:</strong> <?php echo $quadra['arquibancada'] ? 'Sim' : 'Não'; ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card border-0 shadow-lg" style="background-color: #fff; color: #333; border-radius: 15px;">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-3">Agendamento</h3>
                        <p class="text-muted">Marque seu momento de lazer</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
                            <span class="fw-bold">Custo por hora:</span>
                            <span class="text-success fw-bold fs-4">R$ <?php echo number_format($quadra['valor_hora'], 2, ',', '.'); ?></span>
                        </div>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Data</label>
                                <input type="date" name="data" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold">Hora Início</label>
                                    <input type="time" name="hora" class="form-control" required>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold">Duração (horas)</label>
                                    <input type="number" name="duracao" class="form-control" value="1" min="1" max="5" step="0.5" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Disponibilidade</label>
                                <div class="text-success"><i class="fas fa-check-circle"></i> Disponível para agendar</div>
                            </div>

                            <button type="submit" name="agendar" class="btn-custom-teal w-100 py-3 text-uppercase fw-bold">
                                Confirmar Agendamento
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>