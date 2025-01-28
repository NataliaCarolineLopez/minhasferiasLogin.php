<?php
// login.php

// Configurações do banco de dados
$host = 'localhost'; // Host do banco de dados (pode ser 'localhost' ou outro se estiver em servidor remoto)
$dbname = 'usuarios'; // Nome do banco de dados
$username = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter email e senha do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar a consulta SQL para evitar SQL Injection
    $sql = "SELECT * FROM login WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // 's' indica que o parâmetro é uma string
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o email existe
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar a senha (usando password_verify se as senhas forem hashadas)
        if (password_verify($senha, $usuario['senha'])) {
            // Se a senha estiver correta
            echo "Login bem-sucedido!";
            // Aqui você pode redirecionar para outra página ou iniciar uma sessão
            // Exemplo de redirecionamento para uma página chamada 'dashboard.php':
            // header("Location: dashboard.php");
            exit();
        } else {
            // Senha incorreta
            echo "Senha incorreta!";
        }
    } else {
        // Email não encontrado
        echo "Email não encontrado!";
    }

    // Fechar a declaração e a conexão
    $stmt->close();
    $conn->close();
} else {
    // Se o método não for POST, exibe um erro ou redireciona para o formulário
    echo "Método inválido.";
}
?>


