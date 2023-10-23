<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda Já</title>
    <link rel="stylesheet" href="estilo_inicial.css">
</head>
<body>
    <div class="head-content">
        <div class="top-bar">
            <img class="logo-top-bar" src="./imagens/logo.png" alt="Logo venda já">
            <div class="search-box">
                <input type="text" class="search-txt" placeholder="Faça sua busca">
            <a href="#" class="search-btn">
                <img src="./imagens/lupa.svg" alt="Lupa pesquisar" height="20px" width="20px">
            </a>
            </div>
            <div class="enter-btn">
                <a href="Login.html">
                    <button class="entrar">
                        <p>Entrar</p>
                    </button>
                </a>
            </div>
        </div>
        
        </div>
        <div class="content-banner">
         <img class="banner" src="./imagens/banner.png" alt="Banner">
        </div>


        <div class="sub-bar">
                <ul class="categories" >
                    <li class="icons-categories"><a href="#">Autos e peças</a></li>
                    <li class="icons-categories"><a href="">Imóveis</a></li>
                    <li class="icons-categories"><a href="">Eletônicos e Celulares</a></li>
                    <li class="icons-categories"><a href="">Para Casa</a></li>
                    <li class="icons-categories"><a href="">Roupas e acessórios</a></li>
                    <li class="icons-categories"><a href="">Esportes e lazer</a></li>
                    <li class="icons-categories"><a href="">Músicas e hobbies</a></li>
                    <li class="icons-categories"><a href="">Artigos infantis</a></li>
                    <li class="icons-categories"><a href="">Serviços</a></li>
                    <li class="icons-categories"><a href="">Outros</a></li>
                </ul>
        </div>

        <div class="section-produtos">
            <?php
            
            $host = "localhost";
            $usuario = "root";
            $senha = "";
            $banco = "vendasja";
            $conexao = mysqli_connect($host, $usuario, $senha, $banco);
    
            if (!$conexao) {
                die("Falha na conexão: " . mysqli_connect_error());
            }
    
            
            $sql = "SELECT ProdutoID, Nome, Preco, ImagemPrincipal, Descricao FROM Produtos";
            $resultado = mysqli_query($conexao, $sql);
    
            if ($resultado) {
                while ($produto = mysqli_fetch_assoc($resultado)) {
                    
                    echo "<div class='produto'>";
                    echo "<img src='imagens/" . $produto['ImagemPrincipal'] . "' alt='" . $produto['Nome'] . "'>";
                    echo "<p>" . $produto['Nome'] . "</p>";
                    echo "<p>Preço: $" . $produto['Preco'] . "</p>";
                    echo "<p>" . $produto['Descricao'] . "</p>";
                    echo "<button class='add-to-cart-btn'>Adicionar ao Carrinho</button>";
                    echo "</div>";
                }
            }
    
            
            mysqli_close($conexao);
            ?>
        </div>
    </body>
    </html>
</body>
</html>