<?php

class Transacao {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Criar transação
    public function criar($user_id, $tipo, $valor, $descricao, $data) {

        $stmt = $this->conn->prepare(
            "INSERT INTO transacoes (user_id, tipo, valor, descricao, data)
             VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->bind_param("isdss", $user_id, $tipo, $valor, $descricao, $data);

        return $stmt->execute();
    }

    // Listar transações do usuário
    public function listarPorUsuario($user_id) {

        $stmt = $this->conn->prepare(
            "SELECT * FROM transacoes WHERE user_id = ? ORDER BY data DESC"
        );

        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Deletar
    public function deletar($id, $user_id) {

        $stmt = $this->conn->prepare(
            "DELETE FROM transacoes WHERE id = ? AND user_id = ?"
        );

        $stmt->bind_param("ii", $id, $user_id);

        return $stmt->execute();
    }
    public function buscarPorId($id, $user_id) {

    $stmt = $this->conn->prepare(
        "SELECT * FROM transacoes WHERE id = ? AND user_id = ?"
    );

    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}

public function atualizar($id, $user_id, $tipo, $valor, $descricao, $data) {

    $stmt = $this->conn->prepare(
        "UPDATE transacoes
         SET tipo = ?, valor = ?, descricao = ?, data = ?
         WHERE id = ? AND user_id = ?"
    );

    $stmt->bind_param("sdssii", $tipo, $valor, $descricao, $data, $id, $user_id);

    return $stmt->execute();
}
public function listarPorUsuarioEMes($user_id, $mes, $ano) {

    $stmt = $this->conn->prepare(
        "SELECT * FROM transacoes 
         WHERE user_id = ? 
         AND MONTH(data) = ? 
         AND YEAR(data) = ?
         ORDER BY data DESC"
    );

    $stmt->bind_param("iii", $user_id, $mes, $ano);
    $stmt->execute();

    return $stmt->get_result();
}
}