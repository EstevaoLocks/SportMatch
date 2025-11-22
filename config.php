<?php
    // iniciando sessão e buffer
    ob_start();
    session_start();

    // Descobre caminho das pastas
    define('BASE_PATH', __DIR__);

    // Descobre caminho da URL
    
    // Caminho do Document Root do servidor (onde o Apache/Nginx serve os arquivos)
    $docRoot = realpath($_SERVER['DOCUMENT_ROOT']);

    // Normaliza barras (windows x linux)
    $docRootNorm = str_replace('\\', '/', $docRoot);
    $basePathNorm = str_replace('\\', '/', BASE_PATH);

    // Tenta extrair a URL base removendo o DOCUMENT_ROOT do caminho físico do projeto
    $baseUrl = str_replace($docRootNorm, '', $basePathNorm);

    // Se o resultado for vazio, usa '/' (projeto na raiz pública)
    $baseUrl = $baseUrl === '' ? '/' : '/' . ltrim($baseUrl, '/');

    // Remove barra final (exceto se for apenas '/')
    if ($baseUrl !== '/') {
        $baseUrl = rtrim($baseUrl, '/');
    }

    // Define BASE_URL (sem protocolo/host)
    define('BASE_URL', $baseUrl);

    // URL completa com protocolo e host
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    define('BASE_FULL_URL', $protocol . '://' . $host . BASE_URL);
?>