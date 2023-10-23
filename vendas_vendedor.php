<?php
session_start();

if (isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] === "vendedor") {
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "vendasja";

    $conexao = mysqli_connect($host, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $vendedorID = $_SESSION['userID'];

   
    $sql = "SELECT v.CompraID, u.Email AS EmailComprador, p.Nome AS NomeProduto, v.Status
            FROM compras v
            INNER JOIN usuarios u ON v.CompradorID = u.UserID
            INNER JOIN produtos p ON v.ProdutoID = p.ProdutoID
            WHERE p.VendedorID = $vendedorID";

    $resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vendas do Vendedor</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1b2a41;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1 {
            width: 100%;
    height: fit-content;
    display: flex;
    flex-direction: column;
    background-color: #324A5F;
    padding: 20px 3%;
    justify-content: center;
    border-bottom: 3px solid #1B2A41;
    margin-top:-9px
        }
    </style>
</head>
<body>
    <h1>Suas Vendas</h1>

    <?php
    if ($resultado) {
        echo "<table border='1'>";
        echo "<tr><th>CompraID</th><th>Comprador</th><th>Produto</th><th>Status</th><th>Ação</th></tr>";
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $row['CompraID'] . "</td>";
            echo "<td>" . $row['EmailComprador'] . "</td>";
            echo "<td>" . $row['NomeProduto'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "<td><a href='finalizar_venda.php?CompraID=" . $row['CompraID'] . "'>Finalizar Venda</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhuma venda pendente.";
    }
    ?>
</body>
</html>

<?php
    mysqli_close($conexao);
} else {
    header("Location: login.html");
    exit();
}
