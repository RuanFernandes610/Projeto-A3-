<?php
session_start();

// Conexão ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "vendasja";
$conexao = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

echo '<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    h2 {
        background-color: #324A5F;
        color: white;
        padding: 10px;
        text-align: center;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        background-color: white;
        margin: 10px;
        padding: 15px;
        border-radius: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    span {
        flex: 1;
    }

    button {
        background-color: #EF5350;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    button:hover {
        background-color: #D32F2F;
    }

    p {
        text-align: right;
        padding: 10px;
        font-weight: bold;
    }
</style>';

if (!empty($_SESSION['carrinho'])) {
    echo "<h2>Seu Carrinho</h2>";
    echo "<ul>";
    $totalCarrinho = 0;

    foreach ($_SESSION['carrinho'] as $produtoID => $quantidade) {
       
        $query = "SELECT Nome, Preco FROM Produtos WHERE ProdutoID = $produtoID";
        $resultado = mysqli_query($conexao, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $produto = mysqli_fetch_assoc($resultado);
            $subtotal = $quantidade * $produto['Preco'];
            $totalCarrinho += $subtotal;

            echo "<li>";
            echo "<span>{$produto['Nome']}</span>";
            echo "<span>Quantidade: $quantidade</span>";
            echo "<span>Preço: R$ {$produto['Preco']}</span>"; 
            echo "<span>Subtotal: R$ $subtotal</span>"; 
            echo "<form method='post' action='remover_carrinho.php'>";
            echo "<input type='hidden' name='ProdutoID' value='$produtoID'>";
            echo "<button type='submit'>Excluir</button>";
            echo "</form>";
            echo "</li>";
        }
    }
    echo "</ul>";
    echo "<p>Total do Carrinho: R$ $totalCarrinho</p>"; 
    echo "<a href='finalizar_compra.php' class='finalizar-compra-btn'>Finalizar Compra</a>";
} else {
    echo "Seu carrinho está vazio.";
}


mysqli_close($conexao);
?>
