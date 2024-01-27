<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Excluir Produto</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<?php
include 'conexao.php';

// Chama a função para conectar ao banco de dados
$conn = conectarBanco();

// Verifica se foi fornecido um ID válido na URL
if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
    $id = $_GET['ID'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_exclusao'])) {
        // Se o formulário foi enviado e a confirmação de exclusão está presente, exclua o produto
        $sql = "DELETE FROM produtos WHERE ID = $id";

        if (mysqli_query($conn, $sql)) {
            echo "Produto excluído com sucesso! Redirecionando para a página de estoque...";
        } else {
            echo "Erro ao excluir o produto: " . mysqli_error($conn);
        }
		header("Refresh: 3; URL=mostra_produto.php");
		exit();
    } else {
        // Se o formulário ainda não foi enviado, exiba a confirmação de exclusão
        
		echo "<div class=\"excluir\">";
		echo "<h2>Excluir Produto</h2>";
        echo "Tem certeza de que deseja excluir este produto?<br>";

        // Formulário de confirmação de exclusão
        echo "<form method='POST' action='excluir.php?ID=$id'>";
        echo "<input type='submit' name='confirmar_exclusao' value='Sim'>";
		echo "<a href='mostra_produto.php'><button class=\"btn-voltar\" type='button'>Não</button></a>";
        echo "</form>";
		echo "</div>";

            
    }

    // Fechando a conexão com o banco de dados
    $conn->close();
} else {
    echo "ID inválido fornecido.";
}
?>
</body>
</html>
