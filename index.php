<?php
session_start();

$_SESSION['conteudo'] = 1;

$errorMessage = '';
if (! empty($_SESSION['login_error'])) {
    $errorMessage = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
} elseif (isset($_GET['error'])) {
    $errorMessage = 'Credenciais inválidas. Tente novamente.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Administração de Conteúdo Blumar</title>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css?v=1.0">
</head>
<body>
    <div class="login-page">
        <div class="login-card" role="main">
            <div class="login-card__header">
                <div class="login-card__logo" aria-hidden="true">B</div>
                <div>
                    <h1>Administração de Conteúdo</h1>
                    <p>Acesse com suas credenciais para continuar.</p>
                </div>
            </div>
            <?php if ($errorMessage): ?>
                <div class="login-card__alert" role="alert">
                    <?php echo htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>
            <form id="formcliente" class="login-card__form" action="lista_conteudo.php" method="post">
                <div class="input-group">
                    <label for="login">Usuário</label>
                    <input type="text" id="login" name="login" placeholder="Digite seu usuário" autocomplete="username" required>
                </div>
                <div class="input-group">
                    <label for="pass">Senha</label>
                    <input type="password" id="pass" name="pass" placeholder="Digite sua senha" autocomplete="current-password" required>
                </div>
                <button type="submit" name="logar" class="login-card__submit">Entrar</button>
            </form>
            <div class="login-card__footer">
                <small>Precisa de ajuda? Entre em contato com o suporte Blumar.</small>
            </div>
        </div>
    </div>
</body>
</html>
