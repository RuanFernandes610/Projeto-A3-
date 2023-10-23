<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['tipoUsuario'] === "vendedor") {
    $host = "localhost";
    $usuario = "root"; 
    $senha = ""; 
    $banco = "vendasja"; 

    $conexao = mysqli_connect($host, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $UserID = $_SESSION['userID']; 
    $imagemNome = $_FILES['imagem']['name'];
    $imagemTmp = $_FILES['imagem']['tmp_name'];

    if (filter_var($UserID, FILTER_VALIDATE_INT) && vendedorExiste($conexao, $UserID)) {
        $diretorioImagens = "imagens/";

        move_uploaded_file($imagemTmp, $diretorioImagens . $imagemNome);

        $sql = "INSERT INTO Produtos (Nome, Descricao, Preco, Categoria, VendedorID, TipoUsuario, ImagemPrincipal)
                VALUES (?, ?, ?, ?, ?, 'Vendedor', ?)";

        $stmt = mysqli_prepare($conexao, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssdsis", $nome, $descricao, $preco, $categoria, $UserID, $imagemNome);

            if (mysqli_stmt_execute($stmt)) {
                echo "Produto cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar o produto: " . mysqli_error($conexao);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta: " . mysqli_error($conexao);
        }

        mysqli_close($conexao);
    } else {
        echo "ID do vendedor inválido ou inexistente.";
    }
} else {
    echo "Você não tem permissão para cadastrar produtos.";
}

function vendedorExiste($conexao, $vendedorID) {
    $sql = "SELECT UserID FROM Usuarios WHERE UserID = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $vendedorID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        return mysqli_stmt_num_rows($stmt) > 0;
    }

    return false;
}
?>
