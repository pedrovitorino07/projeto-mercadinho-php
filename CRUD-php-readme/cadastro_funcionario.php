<?php include 'templates/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main>
    <h2>Cadastro de Funcionário</h2>
    <form action="register.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        
        <button type="submit" name="register">Cadastrar</button>
    </form>
    
    <?php
    if (isset($_POST['register'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO funcionario (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nome, $email, $senha])) {
            echo "Cadastro realizado com sucesso!";
            header("Location: login.php");
            exit();
        } else {
            echo "Erro ao cadastrar funcionário.";
        }
    }
    ?>
</main>

<?php include 'templates/footer.php'; ?>