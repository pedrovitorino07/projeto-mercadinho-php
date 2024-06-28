<?php include 'templates/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main>
    <h2>Editar Pedido</h2>
    
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = 'SELECT * FROM pedido WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $pedido = $stmt->fetch();
        
        if ($pedido) {
            ?>
            <form action="update_pedido.php?id=<?= $id ?>" method="post">
                <label for="cliente_id">Cliente:</label>
                <select name="cliente_id" id="cliente_id" required>
                    <?php
                    $sqlClientes = 'SELECT id, nome FROM cliente';
                    foreach ($pdo->query($sqlClientes) as $row) {
                        $selected = $row['id'] == $pedido['cliente_id'] ? 'selected' : '';
                        echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['nome'] . '</option>';
                    }
                    ?>
                </select>
                
                <label for="data">Data:</label>
                <input type="date" name="data" id="data" value="<?= $pedido['data'] ?>" required>
                
                <label for="total">Total:</label>
                <input type="text" name="total" id="total" value="<?= $pedido['total'] ?>" required>
                
                <button type="submit">Atualizar</button>
            </form>
            <?php
        } else {
            echo '<p>Pedido não encontrado.</p>';
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $cliente_id = $_POST['cliente_id'];
        $data = $_POST['data'];
        $total = $_POST['total'];
        
        $sql = 'UPDATE pedido SET cliente_id = :cliente_id, data = :data, total = :total WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['cliente_id' => $cliente_id, 'data' => $data, 'total' => $total, 'id' => $id]);
        
        echo '<p>Pedido atualizado com sucesso!</p>';
        echo '<a href="index_pedido.php">Atualizar outro pedido</a><br>';
        echo '<a href="index.php">Voltar para página inicial</a>';
    }
    ?>
</main>

<?php include 'templates/footer.php'; ?>
