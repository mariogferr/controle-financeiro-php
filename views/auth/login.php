<?php require_once __DIR__ . '/../partials/header.php'; ?>
<link rel="stylesheet" href="assets/css/style.css">

<div class="container" style="max-width: 420px; margin-top: 80px;">
    <div class="form-card">
        <h2>Login</h2>
        <p>Entre para acessar seu controle financeiro.</p>

        <form method="POST" action="?url=login">
            <div class="form-grid" style="grid-template-columns: 1fr;">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>

            <br>
            <button type="submit">Entrar</button>
        </form>

        <br>
        <a href="?url=register">Criar conta</a>
    </div>
</div>
<?php require_once __DIR__ . '/../partials/header.php'; ?>