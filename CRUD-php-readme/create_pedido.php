<?php
session_start();
if (!isset($_SESSION['funcionario_id'])) {
    header("Location: login.php");
    exit();
}

include 'templates/header.php';
include 'includes/db.php';

function getClientes($pdo) {
    $sql = 'SELECT id, nome FROM cliente';
    return $pdo->query($sql);
}
?>

<main>
    <h2>Adicionar Pedido</h2>
    <form action="create_pedido.php" method="post">
        <label for="cliente_id">Cliente:</label>
        <select name="cliente_id" id="cliente_id" required>
            <option value="">Selecione um cliente</option>
            <?php
            foreach (getClientes($pdo) as $row) {
                echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
            }
            ?>
            <option value="0">Cliente não registrado</option> 
        </select>
        
        <label for="data">Data:</label>
        <input type="date" name="data" id="data" required>
        
        <label for="total">Total:</label>
        <input type="text" name="total" id="total" required>
        
        <button type="submit">Adicionar</button>
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cliente_id = $_POST['cliente_id'];
        $data = $_POST['data'];
        $total = $_POST['total'];
        
        if (empty($cliente_id) || empty($data) || empty($total)) {
            echo '<p style="color: red;">Por favor, preencha todos os campos corretamente.</p>';
        } else {
            try {
                if ($cliente_id == "0") {
                    $sql = 'INSERT INTO pedidos_nao_registrados (data, total) VALUES (:data, :total)';
                    $stmt = $pdo->prepare($sql);
                    if ($stmt->execute(['data' => $data, 'total' => $total])) {
                        echo '<p style="color: orange;">Pedido para cliente não registrado adicionado com sucesso!</p>';
                        echo '<a href="create_pedido.php">Fazer outro pedido</a><br>';
                        echo '<a href="index.php">Voltar para página inicial</a>';
                    } else {
                        echo '<p style="color: red;">Erro ao adicionar pedido para cliente não registrado. Por favor, tente novamente.</p>';
                    }
                } else {
                    $sql = 'INSERT INTO pedido (cliente_id, data, total) VALUES (:cliente_id, :data, :total)';
                    $stmt = $pdo->prepare($sql);
                    if ($stmt->execute(['cliente_id' => $cliente_id, 'data' => $data, 'total' => $total])) {
                        echo '<p style="color: green;">Pedido adicionado com sucesso!</p>';
                        echo '<a href="create_pedido.php">Fazer outro pedido</a><br>';
                        echo '<a href="index.php">Voltar para página inicial</a>';
                    } else {
                        echo '<p style="color: red;">Erro ao adicionar pedido. Por favor, tente novamente.</p>';
                    }
                }
            } catch (PDOException $e) {
                echo 'Erro ao executar a consulta: ' . $e->getMessage();
            }
        }
    }
    ?>
</main>

<?php include 'templates/footer.php'; ?>
