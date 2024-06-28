<?php include 'templates/header.php'; ?>
<?php include 'includes/db.php'; ?>

<main>
    <h2>Lista de Pedidos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = 'SELECT p.id, c.nome, p.data, p.total 
                    FROM pedido p 
                    JOIN cliente c ON p.cliente_id = c.id';
            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nome'] . '</td>';
                echo '<td>' . $row['data'] . '</td>';
                echo '<td>' . $row['total'] . '</td>';
                echo '<td>
                        <a href="update_pedido.php?id=' . $row['id'] . '">Editar</a> | 
                        <a href="delete_pedido.php?id=' . $row['id'] . '">Excluir</a>
                      </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</main>

<?php include 'templates/footer.php'; ?>
