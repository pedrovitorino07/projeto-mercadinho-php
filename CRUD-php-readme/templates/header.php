<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Sistema</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>MERCADINHO DA ESQUINA</h1>
</header>
<nav>
    <a href="index.php">Clientes</a>
    <a href="index_pedido.php">Pedidos</a>
    <?php if (isset($_SESSION['funcionario_id'])): ?>
        <a href="create_pedido.php">Realizar Pedido</a>
        <a href="create.php">Cadastro Cliente</a>
        <a href="cadastro_funcionario.php">Registro de Funcionário</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login de Funcionário</a>
    <?php endif; ?>
</nav>
