<?php include 'templates/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main>
    <h2>Excluir Pedido</h2>
    
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = 'SELECT * FROM pedido WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $pedido = $stmt->fetch();
        
        if ($pedido) {
            ?>
            <p>Tem certeza que deseja excluir o pedido de <strong><?= $pedido['data'] ?></strong>?</p>
            <form action="delete_pedido.php?id=<?= $id ?>" method="post">
                <button type="submit">Excluir</button>
                <a href="index_pedido.php">Cancelar</a>
            </form>
            <?php
        } else {
            echo '<p>Pedido não encontrado.</p>';
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = 'DELETE FROM pedido WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        echo '<p>Pedido excluído com sucesso!</p>';
        echo '<a href="index_pedido.php">Voltar para página de pedidos</a>';
    }
    ?>
</main>

<?php include 'templates/footer.php'; ?>
