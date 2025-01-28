
<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = ($_POST['senha']);

    $sql = "SELECT * FROM usuarios.login WHERE email='$email' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        header('Location: index.html');
    } else {
        $error = "Email ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container" style="width: 400px;">
    <h2>Login</h2>
    <form method="POST"action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <button type="submit" style="margin-bottom: 30px;">Entrar</button>
        <?php if (isset($error)) echo "<p class='messageerror'>$error</p>"; ?>
    </form>
    </div> 
</body>
</html>
