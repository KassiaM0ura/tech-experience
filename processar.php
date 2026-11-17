<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método não permitido. Use o formulário de inscrição.');
}

$nome        = trim($_POST['nome'] ?? '');
$email       = trim($_POST['email'] ?? '');
$experiencia = trim($_POST['experiencia'] ?? '');
$turno       = trim($_POST['turno'] ?? '');
$mensagem    = trim($_POST['mensagem'] ?? '');
$oficinas    = $_POST['oficinas'] ?? [];


$erros = [];

$niveis     = ['iniciante', 'intermediario', 'avancado'];
$turnos     = ['manha', 'noite'];
$permitidas = ['html_css', 'js_dom', 'php_backend'];

if (function_exists('mb_strlen') ? mb_strlen($nome) < 3 : strlen(utf8_decode($nome)) < 3) 

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $erros[] = 'Informe um e-mail válido.';
}
if (!in_array($experiencia, $niveis, true)) {
    $erros[] = 'Selecione um nível de experiência válido.';
}
if (!in_array($turno, $turnos, true)) {
    $erros[] = 'Selecione um turno válido.';
}

if (!is_array($oficinas) || count($oficinas) === 0) {
    $erros[] = 'Selecione pelo menos uma oficina.';
} else {
    foreach ($oficinas as $item) {
        if (!in_array($item, $permitidas, true)) {
            $erros[] = 'Oficina inválida selecionada.';
            break;
        }
    }
}


function e($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultado</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
  <section style="background:#fff;padding:1.5rem;border-radius:8px;max-width:500px;width:100%;">
  <?php if (!empty($erros)): ?>
    <h2>Corrija os erros abaixo</h2>
    <ul>
      <?php foreach ($erros as $erro): ?>
        <li class="error-message"><?= e($erro) ?></li>
      <?php endforeach; ?>
    </ul>
    <a href="index.html">Voltar ao formulário</a>
  <?php else: ?>
    <h2>Inscrição confirmada!</h2>
    <p><strong>Nome:</strong> <?= e($nome) ?></p>
    <p><strong>E-mail:</strong> <?= e($email) ?></p>
    <p><strong>Nível:</strong> <?= e($experiencia) ?></p>
    <p><strong>Turno:</strong> <?= e($turno) ?></p>
    <p><strong>Oficinas:</strong> <?= e(implode(', ', $oficinas)) ?></p>
    <p><strong>Mensagem:</strong> <?= e($mensagem) ?></p>
  <?php endif; ?>
  </section>
</main>
</body>
</html>