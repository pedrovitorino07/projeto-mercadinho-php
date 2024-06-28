<?php
session_start();
include 'templates/header.php';
include 'includes/db.php';
?>

<main>
    <h2>Lista de Clientes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Idade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = 'SELECT * FROM cliente';
            try {
                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['nome']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['idade']) . '</td>';
                    echo '<td>
                            <a href="update.php?id=' . htmlspecialchars($row['id']) . '">Editar</a> | 
                            <a href="delete.php?id=' . htmlspecialchars($row['id']) . '">Excluir</a>
                          </td>';
                    echo '</tr>';
                }
            } catch (PDOException $e) {
                echo 'Erro ao buscar clientes: ' . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</main>

<?php include 'templates/footer.php'; ?>
