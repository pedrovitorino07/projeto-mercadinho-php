<?php include 'templates/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main>
    <h2>Excluir Cliente</h2>
    
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = 'SELECT * FROM cliente WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $cliente = $stmt->fetch();
        
        if ($cliente) {
            ?>
            <p>Tem certeza que deseja excluir o cliente <strong><?= $cliente['nome'] ?></strong>?</p>
            <form action="delete.php?id=<?= $id ?>" method="post">
                <button type="submit">Excluir</button>
            </form>
            <?php
        } else {
            echo '<p>Cliente não encontrado.</p>';
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = 'DELETE FROM pedido WHERE cliente_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        $sql = 'DELETE FROM cliente WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        echo '<p>Cliente excluído com sucesso!</p>';
        echo '<a href="index.php">Voltar para página inicial</a>';
    }
    ?>
</main>

<?php include 'templates/footer.php'; ?>
