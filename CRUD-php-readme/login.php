<?php
session_start();

if (isset($_SESSION['funcionario_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'includes/db.php';

    if (isset($pdo)) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT id, nome, senha FROM funcionario WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            if (password_verify($senha, $funcionario['senha'])) {
                $_SESSION['funcionario_id'] = $funcionario['id'];
                $_SESSION['funcionario_nome'] = $funcionario['nome'];
                header("Location: index.php");
                exit();
            } else {
                $erro_login = "Senha incorreta. Tente novamente.";
            }
        } else {
            $erro_login = "Funcionário não encontrado.";
        }
    } else {
        $erro_login = "Falha na conexão com o banco de dados.";
    }
}
?>

<?php include 'templates/header.php'; ?>

<main>
    <h2>Login de Funcionário</h2>
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        
        <button type="submit">Login</button>
    </form>
    
    <?php if (isset($erro_login)): ?>
        <p style="color: red;"><?php echo $erro_login; ?></p>
    <?php endif; ?>

    <p>Funcionario novo? <a href="register.php">Registre-se</a></p>
</main>

<?php include 'templates/footer.php'; ?>
