<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "vendasja";
$conexao = mysqli_connect($host, $usuario, $senha, $banco);

session_start();

if (isset($_POST['removerProduto'])) {
    $produtoID = $_POST['ProdutoID'];

   
    $sqlExcluirAvaliacoes = "DELETE FROM avaliacoesdeprodutos WHERE ProdutoID = $produtoID";
    if (mysqli_query($conexao, $sqlExcluirAvaliacoes)) {
        echo "Avaliações excluídas com sucesso.<br>";
    } else {
        echo "Erro ao excluir avaliações: " . mysqli_error($conexao) . "<br>";
    }

   
$sqlExcluirCompras = "DELETE FROM compras WHERE ProdutoID = $produtoID";
if (mysqli_query($conexao, $sqlExcluirCompras)) {
    echo "Compras excluídas com sucesso.<br>";
} else {
    echo "Erro ao excluir compras: " . mysqli_error($conexao) . "<br>";
}
/
$sqlExcluirVendas = "DELETE FROM vendas WHERE ProdutoID = $produtoID";
if (mysqli_query($conexao, $sqlExcluirVendas)) {
    echo "Vendas excluídas com sucesso.<br>";
} else {
    echo "Erro ao excluir vendas: " . mysqli_error($conexao) . "<br>";
}
    
    $sqlExcluirProduto = "DELETE FROM produtos WHERE ProdutoID = $produtoID";
    if (mysqli_query($conexao, $sqlExcluirProduto)) {
        echo "Produto excluído com sucesso.<br>";
    } else {
        echo "Erro ao excluir o produto: " . mysqli_error($conexao) . "<br>";
    }

    
    header("Location: vendedor.php");
    exit();
}








mysqli_close($conexao);
?>
