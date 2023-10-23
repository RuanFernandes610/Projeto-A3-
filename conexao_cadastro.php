<?php

$host = "localhost";
$usuario = "root"; 
$senha = ""; 
$banco = "vendasja"; 


$conexao = mysqli_connect($host, $usuario, $senha, $banco);


if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}


$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo_usuario = $_POST['tipo_usuario']; 


$sqlInserirUsuario = "INSERT INTO Usuarios (Nome, Email, Senha, TipoUsuario) VALUES ('$nome', '$email', '$senha', '$tipo_usuario')";


if (mysqli_query($conexao, $sqlInserirUsuario)) {
    echo "Novo usuário inserido com sucesso!";
} else {
    echo "Erro ao inserir novo usuário: " . mysqli_error($conexao);
}


mysqli_close($conexao);
?>

