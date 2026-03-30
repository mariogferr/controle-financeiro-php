<?php require_once __DIR__ . '/../partials/header.php'; ?>
cont<link rel="stylesheet" href="assets/css/style.css">


<?php
$lista = $transacoes->fetch_all(MYSQLI_ASSOC);

$saldo = 0;
$totalReceitas = 0;
$totalDespesas = 0;

foreach ($lista as $t) {
    if ($t['tipo'] === 'receita') {
        $saldo += $t['valor'];
        $totalReceitas += $t['valor'];
    } else {
        $saldo -= $t['valor'];
        $totalDespesas += $t['valor'];
    }
}
?>

<div class="container">

    <div class="topo">
        <h1>Dashboard Financeira</h1>
        <h2>Bem-vindo, <?php echo $_SESSION['user_nome']; ?> 👋</h2>
        <p>Gerencie suas receitas e despesas.</p>
        <a class="logout" href="?url=logout">Sair</a>
    </div>

    <div class="form-card">
        <h3>Filtrar por mês</h3>

        <form method="GET" action="">
            <input type="hidden" name="url" value="dashboard">

            <div class="form-grid">
                <select name="mes" required>
                    <option value="1" <?php echo $mes == 1 ? 'selected' : ''; ?>>Janeiro</option>
                    <option value="2" <?php echo $mes == 2 ? 'selected' : ''; ?>>Fevereiro</option>
                    <option value="3" <?php echo $mes == 3 ? 'selected' : ''; ?>>Março</option>
                    <option value="4" <?php echo $mes == 4 ? 'selected' : ''; ?>>Abril</option>
                    <option value="5" <?php echo $mes == 5 ? 'selected' : ''; ?>>Maio</option>
                    <option value="6" <?php echo $mes == 6 ? 'selected' : ''; ?>>Junho</option>
                    <option value="7" <?php echo $mes == 7 ? 'selected' : ''; ?>>Julho</option>
                    <option value="8" <?php echo $mes == 8 ? 'selected' : ''; ?>>Agosto</option>
                    <option value="9" <?php echo $mes == 9 ? 'selected' : ''; ?>>Setembro</option>
                    <option value="10" <?php echo $mes == 10 ? 'selected' : ''; ?>>Outubro</option>
                    <option value="11" <?php echo $mes == 11 ? 'selected' : ''; ?>>Novembro</option>
                    <option value="12" <?php echo $mes == 12 ? 'selected' : ''; ?>>Dezembro</option>
                </select>

                <input type="number" name="ano" value="<?php echo $ano; ?>" placeholder="Ano" required>
            </div>

            <br>
            <button type="submit">Filtrar</button>
        </form>
    </div>

    <div class="resumo">
        <div class="card saldo">
            <h3>Saldo</h3>
            <p>R$ <?php echo number_format($saldo, 2, ',', '.'); ?></p>
        </div>

        <div class="card receitas">
            <h3>Receitas</h3>
            <p>R$ <?php echo number_format($totalReceitas, 2, ',', '.'); ?></p>
        </div>

        <div class="card despesas">
            <h3>Despesas</h3>
            <p>R$ <?php echo number_format($totalDespesas, 2, ',', '.'); ?></p>
        </div>
    </div>
<div class="card">
    <h3>Receitas vs Despesas</h3>

    <div style="max-width:350px; margin:auto;">
        <canvas id="graficoFinanceiro"></canvas>
    </div>
</div>
    <div class="form-card">
        <h3>Nova Transação</h3>

        <form method="POST" action="?url=transacao/store">
            <div class="form-grid">
                <select name="tipo" required>
                    <option value="">Tipo</option>
                    <option value="receita">Receita</option>
                    <option value="despesa">Despesa</option>
                </select>

                <input type="number" step="0.01" name="valor" placeholder="Valor" required>

                <input type="text" name="descricao" placeholder="Descrição">

                <input type="text" name="data" placeholder="dd/mm/aaaa" required>
            </div>

            <br>
            <button type="submit">Salvar</button>
        </form>
    </div>

    <div class="table-card">
        <h3>Minhas Transações</h3>

        <?php if (count($lista) > 0): ?>
            <table>
                <tr>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Ação</th>
                </tr>

                <?php foreach ($lista as $t): ?>
                    <tr>
                        <td><?php echo ucfirst($t['tipo']); ?></td>

                        <td style="color: <?php echo $t['tipo'] === 'receita' ? 'green' : 'red'; ?>">
                            R$ <?php echo number_format($t['valor'], 2, ',', '.'); ?>
                        </td>

                        <td><?php echo $t['descricao']; ?></td>

                        <td><?php echo date('d/m/Y', strtotime($t['data'])); ?></td>

                        <td class="acoes">
                            <a href="?url=transacao/edit&id=<?php echo $t['id']; ?>">Editar</a>
                            |
                            <a
                                class="excluir"
                                href="?url=transacao/delete&id=<?php echo $t['id']; ?>"
                                onclick="return confirm('Tem certeza que deseja excluir esta transação?');"
                            >
                                Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Nenhuma transação encontrada para este período.</p>
        <?php endif; ?>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const receitas = <?php echo $totalReceitas; ?>;
const despesas = <?php echo $totalDespesas; ?>;

const ctx = document.getElementById('graficoFinanceiro');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Receitas', 'Despesas'],
        datasets: [{
            data: [receitas, despesas],
            backgroundColor: [
                '#2ecc71',
                '#e74c3c'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>