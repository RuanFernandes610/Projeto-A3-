<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "vendasja";
$conexao = mysqli_connect($host, $usuario, $senha, $banco);

session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Página do Vendedor</title>
    <link rel="stylesheet" type="text/css" href="estilo_vendedor.css">
</head>
<body>
    <div class="head-content">
        <div class="top-bar">
            <img class="logo-top-bar" src="./imagens/logo.png" alt="Logo venda já">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="usuario-content">
            <div class="usuario-info-container">
                <p class="bem-vindo">Bem-vindo, Vendedor <?php echo $_SESSION['usuario']; ?>!</p>
                <a href="Cadastrodeprodutos.html" class="visualizar-carrinho-btn">Cadastrar</a>
                <a href="vendas_vendedor.php" class="visualizar-carrinho-btn">Vendas</a>
                <a href="login.html" class="visualizar-carrinho-btn">Sair</a>
            </div>
        </div>

        <?php

    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "vendasja";
    $conexao = mysqli_connect($host, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $UserID = $_SESSION['userID'];

    $sql = "SELECT * FROM produtos WHERE VendedorID = $UserID";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        echo "<div class='container'>";
        echo "<p>Aqui estão os seus anúncios:</p>";

        while ($produto = mysqli_fetch_assoc($resultado)) {
            echo "<div class='produto'>";
            echo "<img src='imagens/" . $produto['ImagemPrincipal'] . "' alt='Nome do Produto'>";
            echo "<h3>" . $produto['Nome'] . "</h3>";
            echo "<p>" . $produto['Descricao'] . "</p>";
            echo "<p>" . $produto['Preco'] . "</p>";
            
            
            $produtoID = $produto['ProdutoID'];
            $sqlComentarios = "SELECT AutorID, Classificacao, Comentario, DataAvaliacao FROM avaliacoesdeprodutos WHERE ProdutoID = $produtoID";
            $resultadoComentarios = mysqli_query($conexao, $sqlComentarios);

            if ($resultadoComentarios) {
                echo "<div class='comentarios-container'>";
                echo "<p>Comentários deste produto:</p>";

                while ($comentario = mysqli_fetch_assoc($resultadoComentarios)) {
                    
                    $autorID = $comentario['AutorID'];

                    
                    $sqlAutor = "SELECT Nome FROM usuarios WHERE UserID = $autorID";
                    $resultadoAutor = mysqli_query($conexao, $sqlAutor);

                    if ($resultadoAutor && $rowAutor = mysqli_fetch_assoc($resultadoAutor)) {
                        $nomeAutor = $rowAutor['Nome'];
                    } else {
                        $nomeAutor = "Nome Desconhecido";
                    }

                    echo "<div class='comentario'>";
                    echo "<p class='autor'>Autor: " . $nomeAutor . "</p>";
                    echo "<p class='classificacao'>Classificação: " . $comentario['Classificacao'] . "</p>";
                    echo "<p class='data'>Data: " . $comentario['DataAvaliacao'] . "</p>";
                    echo "<p class='comentario'>Comentário: " . $comentario['Comentario'] . "</p>";
                    echo "</div>";
                }

                echo "</div>";
            }
            
            echo "<form method='post' action='remover_produto.php'>";
            echo "<input type='hidden' name='ProdutoID' value='" . $produto['ProdutoID'] . "'>";
            echo "<button class='remover-anuncio' type='submit' name='removerProduto'>Remover Anúncio</button>";
            echo "</form>";
            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "<div class='container'>";
        echo "<p>Você não tem produtos cadastrados ou não há comentários em seus produtos.</p>";
        echo "</div>";
    }

    mysqli_close($conexao);
        ?>

    </div>
</body>
</html>
