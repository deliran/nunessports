<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Processamento do formulário de atualização
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
        $preco = mysqli_real_escape_string($conn, $_POST['preco']);

        // Atualiza os dados no banco de dados
        $sql = "UPDATE produtos SET Nome='$nome', Codigo='$codigo', Descricao='$descricao', Preco='$preco' WHERE ID=$id";

        if (mysqli_query($conn, $sql)) {
            echo "Produto atualizado com sucesso! Redirecionando para página de estoque...";
        } else {
            echo "Erro ao atualizar o produto: " . mysqli_error($conn);
			
        }
		// Redirecionar para a página de estoque após 3 segundos
		header("Refresh: 3; URL=mostra_produto.php");
		exit();
    }

    // Query para buscar as informações do produto
    $sql = "SELECT * FROM produtos WHERE ID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nome = $row["Nome"];
        $codigo = $row["Codigo"];
        $descricao = $row["Descricao"];
        $preco = $row["Preco"];
		
		echo "<div class=\"form_editar\">";
        echo "<h2>Editar Produto</h2>";
        echo "<form method='POST' action='editar.php?ID=$id'>";
        echo "<label for='nome'>Nome:</label>";
        echo "<input type='text' id='nome' name='nome' value='$nome' required><br>";
        echo "<label for='codigo'>Código:</label>";
        echo "<input type='text' id='codigo' name='codigo' value='$codigo' required><br>";
        echo "<label for='descricao'>Descrição:</label>";
        echo "<textarea id='descricao' name='descricao' required>$descricao</textarea><br>";
        echo "<label for='preco'>Preço:</label>";
        echo "<input type='text' id='preco' name='preco' value='" . number_format($preco, 2, ',', '.') . "' required><br>";
        echo "<input type='submit' value='Atualizar'>";
		echo "<a href='mostra_produto.php'><button class=\"btn-voltar\" type='button'>Voltar</button></a>";
        echo "</form>";
		echo "</div>";
    } else {
        echo "Produto não encontrado.";
    }
	
	

    // Fechando a conexão com o banco de dados
    $conn->close();
} else {
    echo "ID inválido fornecido.";
}
?>
</body>
</html>
