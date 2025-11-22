<?php
    session_start();
    //chama arquivo que define raíz do projeto
    require_once __DIR__ . '/../../config.php';
    
    include 'conexao.php';

    // Segurança
    if(!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'instituicao'){
        header('Location: login.php'); exit;
    }
    $id_inst = $_SESSION['id'];

    // 1. Processar Cadastro de Nova Quadra
    if(isset($_POST['cadastrar_quadra'])){
        $nome = $_POST['nome_quadra'];
        $tamanho = $_POST['tamanho'];
        $piso = $_POST['composicao'];
        $valor = $_POST['valor'];
        $cep = $_POST['cep']; // Pegando simplificado, ideal pegar do session da inst
        
        // Inserir quadra
        $sql = "INSERT INTO quadra (nome_quadra, tamanho, composicao, valor_hora, cod_instituicao, arquibancada, cobertura, cep, estado, cidade, bairro, rua, numero) 
                VALUES (:nome, :tam, :comp, :val, :inst, 1, 1, '00000-000', 'SP', 'Cidade', 'Bairro', 'Rua', 0)"; 
        // Obs: Simplifiquei endereços fixos para o exemplo funcionar rápido, mas você deve pegar os dados reais do form
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nome'=>$nome, ':tam'=>$tamanho, ':comp'=>$piso, ':val'=>$valor, ':inst'=>$id_inst]);
        echo "<script>alert('Quadra cadastrada!');</script>";
    }

    // 2. Processar Aprovação/Cancelamento
    if(isset($_POST['atualizar_status'])){
        $id_reserva = $_POST['id_reserva'];
        $novo_status = $_POST['novo_status'];
        $motivo = $_POST['motivo'] ?? '';

        $sqlUpdate = "UPDATE reserva SET status = :st, motivo_cancelamento = :mot WHERE cod_reserva = :id";
        $stmt = $pdo->prepare($sqlUpdate);
        $stmt->execute([':st'=>$novo_status, ':mot'=>$motivo, ':id'=>$id_reserva]);
    }

    // Buscar Reservas dessa Instituição
    $sqlReservas = "SELECT r.*, q.nome_quadra, u.nome as nome_user, u.telefone 
                    FROM reserva r 
                    JOIN quadra q ON r.cod_quadra = q.cod_quadra
                    JOIN usuario u ON r.cod_usuario = u.cod_usuario
                    WHERE q.cod_instituicao = :inst ORDER BY r.data_reserva DESC";
    $stmtR = $pdo->prepare($sqlReservas);
    $stmtR->execute([':inst'=>$id_inst]);
    $reservas = $stmtR->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Instituição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <style> a { text-decoration: none; } </style>
</head>
<body style="background-color: #F0F2F5;">
    <?php
        include BASE_PATH . '/pages/includes/navbar.php';
    ?>

    <div class="container mt-5 pt-5">
        <h2 class="text-dark mb-4">Painel de Controle - Instituição</h2>

        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#reservas">Gerenciar Reservas</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#novaquadra">Cadastrar Quadra</button></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="reservas">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Data/Hora</th>
                                    <th>Quadra</th>
                                    <th>Cliente</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reservas as $r): ?>
                                <tr>
                                    <td><?php echo date('d/m/Y H:i', strtotime($r['horario_reserva'])); ?></td>
                                    <td><?php echo $r['nome_quadra']; ?></td>
                                    <td><?php echo $r['nome_user']; ?><br><small><?php echo $r['telefone']; ?></small></td>
                                    <td>R$ <?php echo $r['valor']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $r['status']=='Aprovado'?'bg-success':($r['status']=='Pendente'?'bg-warning':'bg-danger'); ?>">
                                            <?php echo $r['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($r['status'] == 'Pendente'): ?>
                                            <form method="POST" class="d-inline">
                                                <input type="hidden" name="id_reserva" value="<?php echo $r['cod_reserva']; ?>">
                                                <input type="hidden" name="novo_status" value="Aprovado">
                                                <button name="atualizar_status" class="btn btn-success btn-sm">Aprovar</button>
                                            </form>
                                            <button class="btn btn-danger btn-sm" onclick="document.getElementById('cancelForm<?php echo $r['cod_reserva']; ?>').style.display='block'">Recusar</button>
                                            
                                            <div id="cancelForm<?php echo $r['cod_reserva']; ?>" style="display:none;" class="mt-2">
                                                <form method="POST">
                                                    <input type="hidden" name="id_reserva" value="<?php echo $r['cod_reserva']; ?>">
                                                    <input type="hidden" name="novo_status" value="Cancelado">
                                                    <input type="text" name="motivo" placeholder="Motivo do cancelamento" class="form-control form-control-sm mb-1" required>
                                                    <button name="atualizar_status" class="btn btn-dark btn-sm w-100">Confirmar Recusa</button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="novaquadra">
                <div class="card shadow-sm p-4">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Nome da Quadra</label>
                                <input type="text" name="nome_quadra" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Tamanho (ex: 20x40)</label>
                                <input type="text" name="tamanho" class="form-control" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Valor Hora (R$)</label>
                                <input type="number" name="valor" class="form-control" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Piso (Composição)</label>
                                <input type="text" name="composicao" class="form-control" placeholder="Madeira, Concreto..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>CEP Local</label>
                                <input type="text" name="cep" class="form-control">
                            </div>
                        </div>
                        <button type="submit" name="cadastrar_quadra" class="btn-custom-dark">Cadastrar Quadra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        include BASE_PATH . '/pages/includes/footer.php';
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>