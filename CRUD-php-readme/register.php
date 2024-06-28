<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['funcionario_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'includes/db.php';

    if (isset($pdo)) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $senha_confirmacao = $_POST['senha_confirmacao'];

        if ($senha === $senha_confirmacao) {
            $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO funcionario (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            try {
                $stmt->execute([$nome, $email, $senha_hashed]);
                $sucesso_registro = "Funcionário registrado com sucesso!";
            } catch (PDOException $e) {
                $erro_registro = "Erro ao registrar funcionário: " . $e->getMessage();
            }
        } else {
            $erro_registro = "As senhas não coincidem. Tente novamente.";
        }
    } else {
        $erro_registro = "Falha na conexão com o banco de dados.";
    }
}
?>

<?php include 'templates/header.php'; ?>

<main>
    <h2>Registro de Funcionário</h2>
    <form action="register.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        
        <label for="senha_confirmacao">Confirme a Senha:</label>
        <input type="password" name="senha_confirmacao" id="senha_confirmacao" required>
        
        <button type="submit">Registrar</button>
    </form>
    
    <?php if (isset($erro_registro)): ?>
        <p style="color: red;"><?php echo $erro_registro; ?></p>
    <?php endif; ?>
    
    <?php if (isset($sucesso_registro)): ?>
        <p style="color: green;"><?php echo $sucesso_registro; ?></p>
    <?php endif; ?>

    <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
</main>

<?php include 'templates/footer.php'; ?>
