<?php

require_once __DIR__ . '/../models/Transacao.php';
require_once __DIR__ . '/../config/database.php';

class TransacaoController {

    public function index() {

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ?url=login");
        exit;
    }

    require __DIR__ . '/../config/database.php'; // AQUI

    $transacaoModel = new Transacao($conn);

    $transacoes = $transacaoModel->listarPorUsuario($_SESSION['user_id']);

    require_once __DIR__ . '/../views/dashboard/index.php';
}

   public function store() {

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ?url=login");
        exit;
    }

    require __DIR__ . '/../config/database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $tipo = $_POST['tipo'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];

        $dataObj = DateTime::createFromFormat('d/m/Y', $_POST['data']);

        if (!$dataObj) {
            echo "Data inválida. Use o formato dd/mm/aaaa.";
            exit;
        }

        $data = $dataObj->format('Y-m-d');

        $transacaoModel = new Transacao($conn);

        $salvou = $transacaoModel->criar(
            $_SESSION['user_id'],
            $tipo,
            $valor,
            $descricao,
            $data
        );

        if (!$salvou) {
            echo "Erro ao salvar transação.";
            exit;
        }

        header("Location: ?url=dashboard&mes=" . $dataObj->format('n') . "&ano=" . $dataObj->format('Y'));
        exit;
    }
}

   public function delete() {

    session_start();

    require __DIR__ . '/../config/database.php'; // AQUI

    $id = $_GET['id'];

    $transacaoModel = new Transacao($conn);

    $transacaoModel->deletar($id, $_SESSION['user_id']);

    header("Location: ?url=dashboard");
    exit;
}
public function edit() {

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ?url=login");
        exit;
    }

    require __DIR__ . '/../config/database.php';

    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo "Transação não encontrada.";
        exit;
    }

    $transacaoModel = new Transacao($conn);

    $transacao = $transacaoModel->buscarPorId($id, $_SESSION['user_id']);

    if (!$transacao) {
        echo "Transação não encontrada.";
        exit;
    }

    require_once __DIR__ . '/../views/dashboard/edit.php';
}

public function update() {

    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ?url=login");
        exit;
    }

    require __DIR__ . '/../config/database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $_POST['id'];
        $tipo = $_POST['tipo'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];

        $dataObj = DateTime::createFromFormat('d/m/Y', $_POST['data']);

        if (!$dataObj) {
            echo "Data inválida. Use o formato dd/mm/aaaa.";
            exit;
        }

        $data = $dataObj->format('Y-m-d');

        $transacaoModel = new Transacao($conn);

        $transacaoModel->atualizar(
            $id,
            $_SESSION['user_id'],
            $tipo,
            $valor,
            $descricao,
            $data
        );

        header("Location: ?url=dashboard");
        exit;
    }
}
}