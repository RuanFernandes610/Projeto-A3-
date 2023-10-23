<?php
session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] === "comprador") {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ProdutoID'])) {
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "vendasja";
        $conexao = mysqli_connect($host, $usuario, $senha, $banco);

        if (!$conexao) {
            die("Falha na conexão: " . mysqli_connect_error());
        }

        $compradorID = $_SESSION['userID'];
        $produtos = $_POST['ProdutoID'];
        $dataCompra = date('Y-m-d H:i:s');
        $status = 'Aguardando pagamento';

        foreach ($produtos as $produtoID) {
            $sql = "INSERT INTO compras (CompradorID, ProdutoID, DataCompra, Status) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conexao, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iiss", $compradorID, $produtoID, $dataCompra, $status);

                if (mysqli_stmt_execute($stmt)) {
                    // Sucesso
                } else {
                    echo "Erro ao registrar a compra: " . mysqli_error($conexao);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Erro na preparação da consulta: " . mysqli_error($conexao);
            }
        }

        unset($_SESSION['carrinho']);
        header("Location: confirmacao_compra.php");
        exit();
    }
} else {
    header("Location: login.html");
    exit();
}
?>
