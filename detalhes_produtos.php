<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Produto</title>
    <style>
body {
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin: 0;
    padding: 0;
    cursor: default;
    background-image: url(./imagens/dotted.jfif);
    background-position: center;
    background-size: contain;
    background-repeat: repeat;
}

.top-bar {
    width: 100%;
    height: fit-content;
    display: flex;
    flex-direction: column;
    background-color: #324A5F;
    padding: 15px 3%;
    justify-content: center;
    border-bottom: 3px solid #1B2A41;
}


.produto-container {
    max-width: 600px;
    padding: 20px;
    border: 2px solid #b6c8a9;
    margin-top: 30px;
    background-color: #fff;
}

.produto-img {
    max-width: 100%;
}

.btn-adicionar {
    padding: 10px 20px;
    background-color: #B6C8A9;
    border: none;
    border-radius: 30px;
    color: #1B2A41;
    font-weight: bold;
    text-decoration: none;
    margin-left: 10px;
    transition: background-color 0.5s ease;
}

.comentarios-container {
    text-align: center;
    margin-top: 20px;
}

.comentario {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 15px;
    margin: 15px 0;
    background-color: #f9f9f9;
}

.comentario p {
    margin: 5px 0;
}

.comentario .autor {
    font-weight: bold;
}

.comentario .classificacao {
    color: #1b2a41;
}

.comentario .data {
    font-style: italic;
}

.comentario-form {
    margin: 10px 0;
}

.comentario-form label {
    display: block;
    font-weight: bold;
}

.comentario-form select,
.comentario-form textarea {
    width: 94%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.comentario-form button {
    padding: 10px 20px;
    background-color: #B6C8A9;
    border: none;
    border-radius: 30px;
    color: #1B2A41;
    font-weight: bold;
    text-decoration: none;
    margin-left: 10px;
    transition: background-color 0.5s ease;
}
    </style>
</head>
<body>
    <div class="top-bar">
        <h1>Detalhes do Produto</h1>
    </div>

    <div class="produto-container">
        <?php
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "vendasja";
        $conexao = mysqli_connect($host, $usuario, $senha, $banco);
        if (!$conexao) {
            die("Falha na conexão: " . mysqli_connect_error());
        }

        if (isset($_GET['ProdutoID'])) {
            $produtoID = $_GET['ProdutoID'];
            $sql = "SELECT ProdutoID, Nome, Preco, ImagemPrincipal, Descricao FROM Produtos WHERE ProdutoID = $produtoID";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
                echo "<img class='produto-img' src='imagens/" . $row['ImagemPrincipal'] . "' alt='" . $row['Nome'] . "'>";
                echo "<h2>" . $row['Nome'] . "</h2>";
                echo "<p>Preço: $" . $row['Preco'] . "</p>";
                echo "<p>" . $row['Descricao'] . "</p>";
            } else {
                echo "Produto não encontrado.";
            }
        } else {
            echo "Produto não especificado.";
        }
        

        mysqli_close($conexao);
        ?>
        <form method="post" action="adicionar_carrinho.php">
            <input type="hidden" name="ProdutoID" value="<?php echo $produtoID; ?>">
            <button class="btn-adicionar" type="submit">Adicionar ao Carrinho</button>
        </form>
        <div class="comentarios-container">
            <h3>Comentários de outros usuários:</h3>
            <?php
            $host = "localhost";
            $usuario = "root";
            $senha = "";
            $banco = "vendasja";
            $conexao = mysqli_connect($host, $usuario, $senha, $banco);

            if (!$conexao) {
                die("Falha na conexão: " . mysqli_connect_error());
            }

            $sql = "SELECT AutorID, Classificacao, Comentario, DataAvaliacao FROM avaliacoesdeprodutos WHERE ProdutoID = $produtoID";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                while ($comentario = mysqli_fetch_assoc($resultado)) {
                    echo "<div class='comentario'>";
                    
                    $autorID = $comentario['AutorID'];
                    $sql = "SELECT Nome FROM usuarios WHERE UserID = $autorID";
                    $resultadoAutor = mysqli_query($conexao, $sql);

                    if ($resultadoAutor && $rowAutor = mysqli_fetch_assoc($resultadoAutor)) {
                        $nomeAutor = $rowAutor['Nome'];
                    } else {
                        $nomeAutor = "Nome Desconhecido";
                    }

                    echo "<p class='autor'>Autor: " . $nomeAutor . "</p>";
                    echo "<p class='classificacao'>Classificação: " . $comentario['Classificacao'] . "</p>";
                    echo "<p class='data'>Data: " . $comentario['DataAvaliacao'] . "</p>";
                    echo "<p class='comentario'>Comentário: " . $comentario['Comentario'] . "</p>";
                    echo "</div>";
                }
            }

            mysqli_close($conexao);
            ?>
        </div>
        <h3>Adicionar Comentário:</h3>
        <form method="post" action="adicionar_comentario.php">
            <input type="hidden" name="ProdutoID" value="<?php echo $produtoID; ?>">
            <input type="hidden" name="AutorID" value="<?php echo $_SESSION['UserID']; ?>">
            <div class="comentario-form">
                <label for="classificacao">Classificação:</label>
                <select id="classificacao" name="classificacao">
                    <option value="1">1 Estrela</option>
                    <option value="2">2 Estrelas</option>
                    <option value="3">3 Estrelas</option>
                    <option value="4">4 Estrelas</option>
                    <option value="5">5 Estrelas</option>
                </select>
            </div>
            <div class="comentario-form">
                <label for="comentario">Comentário:</label>
                <textarea id="comentario" name="comentario" rows="4"></textarea>
            </div>
            <div class="comentario-form">
                <button type="submit">Adicionar Comentário</button>
            </div>
        </form>
    </div>
</body>
</html>
