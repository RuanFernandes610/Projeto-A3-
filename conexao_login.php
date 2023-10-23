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

    $email = $_POST['email'];
    $password = $_POST['senha'];

    $sql = "SELECT UserID, Nome, TipoUsuario FROM Usuarios WHERE Email = '$email' AND Senha = '$password'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario'] = $row['Nome'];
        $_SESSION['tipoUsuario'] = $row['TipoUsuario'];
        $_SESSION['userID'] = $row['UserID']; 

        
        error_log("UserID: " . $_SESSION['userID']); 

        if ($_SESSION['tipoUsuario'] === "vendedor") {
            header("Location: vendedor.php");
            exit();
        } elseif ($_SESSION['tipoUsuario'] === "comprador") {
            header("Location: Comprador.php");
            exit();
        }
    } else {
        echo "Login falhou. Por favor, verifique suas credenciais.";
    }

    mysqli_close($conexao);
} else {
    header("Location: login.html");
    exit();
}
?>
