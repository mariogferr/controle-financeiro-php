<?php require_once __DIR__ . '/../partials/header.php'; ?>
<link rel="stylesheet" href="assets/css/style.css">

<div class="container">
    <div class="form-card">
        <h2>Editar Transação</h2>

        <form method="POST" action="?url=transacao/update">
            <input type="hidden" name="id" value="<?php echo $transacao['id']; ?>">

            <div class="form-grid">
                <select name="tipo" required>
                    <option value="receita" <?php echo $transacao['tipo'] === 'receita' ? 'selected' : ''; ?>>
                        Receita
                    </option>
                    <option value="despesa" <?php echo $transacao['tipo'] === 'despesa' ? 'selected' : ''; ?>>
                        Despesa
                    </option>
                </select>

                <input
                    type="number"
                    step="0.01"
                    name="valor"
                    value="<?php echo $transacao['valor']; ?>"
                    required
                >

                <input
                    type="text"
                    name="descricao"
                    value="<?php echo $transacao['descricao']; ?>"
                    placeholder="Descrição"
                >

                <input
                    type="text"
                    name="data"
                    value="<?php echo date('d/m/Y', strtotime($transacao['data'])); ?>"
                    placeholder="dd/mm/aaaa"
                    required
                >
            </div>

            <br>
            <button type="submit">Atualizar</button>
        </form>

        <br>
        <a href="?url=dashboard">Voltar</a>
    </div>
</div>
<?php require_once __DIR__ . '/../partials/header.php'; ?>