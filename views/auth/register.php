<?php require_once __DIR__ . '/../partials/header.php'; ?>
<link rel="stylesheet" href="assets/css/style.css">

<div class="container" style="max-width: 420px; margin-top: 80px;">
    <div class="form-card">
        <h2>Cadastro</h2>
        <p>Crie sua conta para começar a usar o sistema.</p>

        <form method="POST" action="?url=register">
            <div class="form-grid" style="grid-template-columns: 1fr;">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>

            <br>
            <button type="submit">Cadastrar</button>
        </form>

        <br>
        <a href="?url=login">Já tenho conta</a>
    </div>
</div>
<?php require_once __DIR__ . '/../partials/header.php'; ?>