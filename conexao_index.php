<?php

$host = "localhost";
$usuario = "root"; 
$senha = ""; 
$banco = "vendasja"; 


$conexao = mysqli_connect($host, $usuario, $senha, $banco);


if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$sql = "SELECT ProdutoID, Nome, Preco, Imagem, Descricao FROM Produtos";
$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    while ($produto = mysqli_fetch_assoc($resultado)) {
        // Exiba os produtos em um box
        echo "<div class='product-box'>";
        echo "<img class='produto-img' src='imagens/" . $row['ImagemPrincipal'] . "' alt='" . $row['Nome'] . "'>";
        echo "<p>" . $produto['Nome'] . "</p>";
        echo "<p>Preço: $" . $produto['Preco'] . "</p>";
        echo "<p>" . $produto['Descricao'] . "</p>";
        echo "<button class='add-to-cart-btn'>Adicionar ao Carrinho</button>";
        echo "</div>";
    }
}
mysqli_close($conexao);
?>