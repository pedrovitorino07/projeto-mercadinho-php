<?php include 'templates/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main>
    <h2>Adicionar Cliente</h2>
    <form action="create.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" required>
        
        <button type="submit">Adicionar</button>
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $idade = $_POST['idade'];
        
        $sql = 'INSERT INTO cliente (nome, email, idade) VALUES (:nome, :email, :idade)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nome' => $nome, 'email' => $email, 'idade' => $idade]);
        
        echo '<p>Cliente adicionado com sucesso!</p>';
        echo '<a href="create.php">Adicionar outro cliente</a><br>';
        echo '<a href="index.php">Voltar para página inicial</a>';
    }
    ?>

</main>

<?php include 'templates/footer.php'; ?>
