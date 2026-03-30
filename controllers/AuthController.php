<?php

class AuthController {

    // LOGIN
    public function login() {

        session_start();

        require_once 'config/database.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows === 1) {

                $user = $result->fetch_assoc();

                if (password_verify($senha, $user['senha'])) {

                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_nome'] = $user['nome'];

                    header("Location: ?url=dashboard");
                    exit;

                } else {
                    echo "Senha incorreta!";
                }

            } else {
                echo "Usuário não encontrado!";
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    // REGISTER (CADASTRO)
    public function register() {

        require_once 'config/database.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $senha);

            if ($stmt->execute()) {
                echo "Usuário cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar!";
            }
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }

    // 📌 LOGOUT
    public function logout() {

        session_start();
        session_destroy();

        header("Location: ?url=login");
        exit;
    }
}
