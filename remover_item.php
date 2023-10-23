<?php
session_start();

if (isset($_GET['CarrinhoID'])) {
    $carrinhoID = $_GET['CarrinhoID'];

   
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "vendasja";
    $conexao = mysqli_connect($host, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $userID = $_SESSION['userID']; 
    $sql = "DELETE FROM carrinhodecompras WHERE UserID = $userID AND CarrinhoID = $carrinhoID";

    if (mysqli_query($conexao, $sql)) {
        header("Location: carrinho.php");
        exit();
    } else {
        echo "Erro ao remover o item do carrinho: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
} else {
    header("Location: carrinho.php");
    exit();
}
?>
