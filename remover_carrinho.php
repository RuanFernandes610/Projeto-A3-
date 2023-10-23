<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ProdutoID'])) {
    $produtoID = $_POST['ProdutoID'];

    if (isset($_SESSION['carrinho'][$produtoID])) {
        unset($_SESSION['carrinho'][$produtoID]);
    }


    header("Location: carrinho_session.php");
    exit();
}
?>
