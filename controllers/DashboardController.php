<?php

require_once __DIR__ . '/../models/Transacao.php';

class DashboardController {

    public function index() {

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ?url=login");
        exit;
    }

    require __DIR__ . '/../config/database.php';

    $transacaoModel = new Transacao($conn);

    $mes = $_GET['mes'] ?? date('n');
    $ano = $_GET['ano'] ?? date('Y');

    $transacoes = $transacaoModel->listarPorUsuarioEMes(
        $_SESSION['user_id'],
        (int)$mes,
        (int)$ano
    );

    require_once __DIR__ . '/../views/dashboard/index.php';
}
}