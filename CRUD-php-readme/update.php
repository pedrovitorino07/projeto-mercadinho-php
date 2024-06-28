<?php
include 'templates/header.php';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];

    try {
        $sql = 'UPDATE cliente SET Nome = :nome, Email = :email, Idade = :idade WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nome' => $nome, 'email' => $email, 'idade' => $idade, 'id' => $id]);

        echo '<p>Cliente atualizado com sucesso!</p>';
        echo '<a href="update.php?id=' . $id . '">Editar outro cliente</a><br>';
        echo '<a href="index.php">Voltar para página inicial</a>';
    } catch (PDOException $e) {
        echo 'Erro ao atualizar cliente: ' . $e->getMessage();
    }
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'SELECT * FROM cliente WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $cliente = $stmt->fetch();

    if ($cliente) {
        ?>
        <main>
            <h2>Editar Cliente</h2>
            <form action="update.php?id=<?= $id ?>" method="post">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
                
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
                
                <label for="idade">Idade:</label>
                <input type="number" name="idade" id="idade" value="<?= htmlspecialchars($cliente['idade']) ?>" required>
                
                <button type="submit">Atualizar</button>
            </form>
        </main>
        <?php
    } else {
        echo '<p>Cliente não encontrado.</p>';
    }
} else {
    echo '<p>ID do cliente não fornecido.</p>';
}

include 'templates/footer.php';
?>
