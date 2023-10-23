<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "vendasja";
    $conexao = mysqli_connect($host, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $autorID = $_POST['AutorID'];
    $classificacao = $_POST['classificacao'];
    $comentario = $_POST['comentario'];
    $produtoID = $_POST['ProdutoID'];
    

    $dataAvaliacao = date('Y-m-d H:i:s');

    
    if (isset($_SESSION['userID'])) {
        
        $autorID = $_SESSION['userID'];
        
    } else {
        
        echo "Usuário não logado.";
    }

        $sql = "INSERT INTO avaliacoesdeprodutos (AutorID, ProdutoID, Classificacao, Comentario, DataAvaliacao) VALUES ('$autorID', '$produtoID', '$classificacao', '$comentario', '$dataAvaliacao')";

        if (mysqli_query($conexao, $sql)) {
            echo "Avaliação adicionada com sucesso.";
        } else {
            echo "Erro ao adicionar a avaliação: " . mysqli_error($conexao);
        }
    } else {
        echo "Usuário não logado.";
    }
?>
