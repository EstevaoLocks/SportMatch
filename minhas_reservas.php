<?php
    $is_profilePg = false;
    session_start();
    include 'sistema/conexao.php';

    if(!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] != 'usuario'){
        header('Location: login.php'); exit;
    }
    $id_user = $_SESSION['id'];

    // Cancelar agendamento
    if(isset($_POST['cancelar_reserva'])){
        $id_res = $_POST['id_reserva'];
        $motivo = $_POST['motivo'];
        
        $sql = "UPDATE reserva SET status = 'Cancelado', motivo_cancelamento = :mot WHERE cod_reserva = :id AND cod_usuario = :user";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':mot'=>$motivo, ':id'=>$id_res, ':user'=>$id_user]);
    }

    $sql = "SELECT r.*, q.nome_quadra, i.nome as nome_inst 
            FROM reserva r 
            JOIN quadra q ON r.cod_quadra = q.cod_quadra
            JOIN instituicao i ON q.cod_instituicao = i.cod_instituicao
            WHERE r.cod_usuario = :user ORDER BY r.data_reserva DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user'=>$id_user]);
    $minhas_reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Reservas</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style> a { text-decoration: none; } </style>
</head>
<body style="background-color: #F0F2F5;">
    <?php include 'navbar.php'; ?>

    <div class="container mt-5 pt-5">
        <h2 class="mb-4">Minhas Reservas</h2>
        
        <div class="row">
            <?php foreach($minhas_reservas as $r): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <strong class="text-primary"><?php echo $r['nome_quadra']; ?></strong>
                        <span class="badge <?php echo $r['status']=='Aprovado'?'bg-success':($r['status']=='Cancelado'?'bg-danger':'bg-warning'); ?>">
                            <?php echo $r['status']; ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="mb-1"><strong>Local:</strong> <?php echo $r['nome_inst']; ?></p>
                        <p class="mb-1"><strong>Data:</strong> <?php echo date('d/m/Y', strtotime($r['horario_reserva'])); ?></p>
                        <p class="mb-1"><strong>Horário:</strong> <?php echo date('H:i', strtotime($r['horario_reserva'])); ?></p>
                        <p class="mb-3"><strong>Valor:</strong> R$ <?php echo $r['valor']; ?></p>
                        
                        <?php if($r['status'] == 'Cancelado'): ?>
                            <div class="alert alert-danger p-2 small">
                                <strong>Motivo:</strong> <?php echo $r['motivo_cancelamento']; ?>
                            </div>
                        <?php elseif($r['status'] == 'Pendente' || $r['status'] == 'Aprovado'): ?>
                             <button class="btn btn-outline-danger btn-sm w-100" type="button" data-bs-toggle="collapse" data-bs-target="#cancelArea<?php echo $r['cod_reserva']; ?>">
                                Cancelar Agendamento
                             </button>
                             <div class="collapse mt-2" id="cancelArea<?php echo $r['cod_reserva']; ?>">
                                <form method="POST">
                                    <input type="hidden" name="id_reserva" value="<?php echo $r['cod_reserva']; ?>">
                                    <textarea name="motivo" class="form-control mb-2" placeholder="Por que deseja cancelar?" required></textarea>
                                    <button name="cancelar_reserva" class="btn btn-danger btn-sm w-100">Confirmar Cancelamento</button>
                                </form>
                             </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>