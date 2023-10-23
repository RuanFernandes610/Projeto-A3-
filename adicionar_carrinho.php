<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['ProdutoID'])) {
    $produtoID = $_GET['ProdutoID'];

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (!isset($_SESSION['carrinho'][$produtoID])) {
        $_SESSION['carrinho'][$produtoID] = 1; 
    } else {
        $_SESSION['carrinho'][$produtoID]++;
    }

   
    header("Location: carrinho_session.php.?ProdutoID=" . $produtoID);
    exit();
}
