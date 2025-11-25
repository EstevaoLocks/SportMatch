<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/conexao.php';

// Inicia sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) session_start();

// --- VERIFICAÇÃO DE SEGURANÇA ---
// Se não existir o ID da instituição na sessão, bloqueia o acesso
if (!isset($_SESSION['cod_instituicao'])) {
    // Se for um usuário comum logado, manda para a home
    if (isset($_SESSION['cod_usuario'])) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
    // Se não estiver logado, manda para o login
    header('Location: ' . BASE_URL . '/pages/login.php');
    exit;
}
// --------------------------------

// Busca modalidades para o select
try {
    $stmtMods = $pdo->query("SELECT * FROM modalidade ORDER BY nome_mod");
    $modalidades = $stmtMods->fetchAll();
} catch (PDOException $e) {
    $modalidades = [];
}

$mensagem = "";
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Dados básicos
    $nome = $_POST['nome_quadra'];
    $valor = str_replace(',', '.', $_POST['valor_hora']); // Troca vírgula por ponto
    $tamanho = $_POST['tamanho'];
    $composicao = $_POST['composicao'];
    $modalidadeID = $_POST['modalidade'];
    
    $arquibancada = isset($_POST['arquibancada']) ? 1 : 0;
    $cobertura = isset($_POST['cobertura']) ? 1 : 0;

    // Endereço
    $cep = $_POST['cep'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

    // ID DA INSTITUIÇÃO (Pega da sessão verificada acima)
    $codInstituicao = $_SESSION['cod_instituicao']; 

    // --- LÓGICA DE UPLOAD ---
    $nomeImagem = null;
    if (isset($_FILES['foto_quadra']) && $_FILES['foto_quadra']['error'] === 0) {
        $extensao = pathinfo($_FILES['foto_quadra']['name'], PATHINFO_EXTENSION);
        $novoNome = "quadra_" . time() . "_" . rand(1000,9999) . "." . $extensao;
        
        $pastaDestino = BASE_PATH . "/assets/img/quadras/";
        $destinoArquivo = $pastaDestino . $novoNome;

        // Cria pasta se não existir
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        if (move_uploaded_file($_FILES['foto_quadra']['tmp_name'], $destinoArquivo)) {
            $nomeImagem = $novoNome;
        } else {
            $erro = "Erro ao salvar a imagem no servidor. Verifique as permissões da pasta.";
        }
    }

    if (empty($erro)) {
        try {
            $pdo->beginTransaction();

            $sqlQuadra = "INSERT INTO quadra (nome_quadra, arquibancada, cobertura, tamanho, composicao, cep, estado, cidade, bairro, rua, numero, valor_hora, cod_instituicao, imagem) 
                          VALUES (:nome, :arq, :cob, :tam, :comp, :cep, :uf, :cid, :bairro, :rua, :num, :val, :inst, :img)";
            
            $stmt = $pdo->prepare($sqlQuadra);
            $stmt->execute([
                ':nome' => $nome, ':arq' => $arquibancada, ':cob' => $cobertura,
                ':tam' => $tamanho, ':comp' => $composicao, ':cep' => $cep,
                ':uf' => $estado, ':cid' => $cidade, ':bairro' => $bairro,
                ':rua' => $rua, ':num' => $numero, ':val' => $valor,
                ':inst' => $codInstituicao, ':img' => $nomeImagem
            ]);

            $idQuadra = $pdo->lastInsertId();

            $sqlMod = "INSERT INTO quadra_mod (cod_quadra, cod_modalidade) VALUES (:idq, :idm)";
            $stmtMod = $pdo->prepare($sqlMod);
            $stmtMod->execute([':idq' => $idQuadra, ':idm' => $modalidadeID]);

            $pdo->commit();
            $mensagem = "Quadra cadastrada com sucesso!";
        } catch (Exception $e) {
            $pdo->rollBack();
            $erro = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Quadra - SportMatch</title>
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/reset.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/form.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body class="body-form">

    <?php include BASE_PATH . '/pages/includes/navbar.php'; ?>

    <main class="main-content">
        <div class="form-box">
            <h2>Cadastrar Nova Quadra</h2>

            <?php if($mensagem): ?>
                <div class="msg-success"><?php echo $mensagem; ?> <br> <a href="<?php echo BASE_URL; ?>/pages/quadras.php" style="text-decoration: underline;">Ver na lista</a></div>
            <?php endif; ?>
            <?php if($erro): ?>
                <div class="msg-error"><?php echo $erro; ?></div>
            <?php endif; ?>

            <form method="POST" action="" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label>Nome da Quadra / Título do Anúncio</label>
                    <input type="text" name="nome_quadra" required placeholder="Ex: Arena Show de Bola">
                </div>

                <div class="row-inputs">
                    <div class="form-group col-half">
                        <label>Modalidade (Esporte)</label>
                        <select name="modalidade" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($modalidades as $mod): ?>
                                <option value="<?php echo $mod['cod_modalidade']; ?>">
                                    <?php echo htmlspecialchars($mod['nome_mod']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-half">
                        <label>Valor por Hora (R$)</label>
                        <input type="text" name="valor_hora" required placeholder="0.00">
                    </div>
                </div>

                <div class="row-inputs">
                    <div class="form-group col-half">
                        <label>Tamanho (Dimensões)</label>
                        <input type="text" name="tamanho" required placeholder="Ex: 20x40">
                    </div>
                    <div class="form-group col-half">
                        <label>Tipo de Piso/Composição</label>
                        <input type="text" name="composicao" required placeholder="Ex: Grama Sintética, Madeira...">
                    </div>
                </div>

                <div class="form-group">
                    <label>Características Extras</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" name="arquibancada" id="arq">
                            <label for="arq">Possui Arquibancada</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="cobertura" id="cob">
                            <label for="cob">É Coberta</label>
                        </div>
                    </div>
                </div>

                <hr>
                <h3>Localização</h3>

                <div class="row-inputs">
                    <div class="form-group" style="width: 30%;">
                        <label>CEP</label>
                        <input type="text" name="cep" required placeholder="00000-000">
                    </div>
                    <div class="form-group" style="width: 70%;">
                        <label>Rua</label>
                        <input type="text" name="rua" required placeholder="Nome da rua">
                    </div>
                </div>

                <div class="row-inputs">
                    <div class="form-group" style="width: 20%;">
                        <label>Número</label>
                        <input type="number" name="numero" required>
                    </div>
                    <div class="form-group" style="width: 40%;">
                        <label>Bairro</label>
                        <input type="text" name="bairro" required placeholder="Bairro">
                    </div>
                    <div class="form-group" style="width: 40%;">
                        <label>Cidade</label>
                        <input type="text" name="cidade" required placeholder="Cidade">
                    </div>
                </div>

                <div class="form-group">
                    <label>Estado (UF)</label>
                    <input type="text" name="estado" maxlength="2" style="width: 100px;" placeholder="SP">
                </div>

                <hr>
                
                <div class="form-group">
                    <label>Foto da Quadra (Para o Card)</label>
                    <div class="file-upload">
                        <input type="file" name="foto_quadra" accept="image/*">
                        <p style="color: #8D99AE; font-size: 0.9rem; margin-top: 10px;">Clique para escolher um arquivo (JPG, PNG). Máx: 2MB.</p>
                    </div>
                </div>

                <button type="submit" class="btn-submit-form">CADASTRAR QUADRA</button>
            </form>
        </div>
    </main>

    <?php include BASE_PATH . '/pages/includes/footer.php'; ?>
</body>
</html>