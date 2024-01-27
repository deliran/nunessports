<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Lista de Produtos Cadastrados</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
<div>
<table>
<h2>Controle de Produto</h2>
<tr>
<th>Nome</th>
<th>Código</th>
<th>Descrição</th>
<th>Preço</th>
<th>Ações</th>
</tr>

<?php

include 'conexao.php';

// Chama a função para conectar ao banco de dados
$conn = conectarBanco();

// Select all products
$sql = "SELECT * FROM produtos";
$result = mysqli_query($conn, $sql);

// Loop through the results and display them in a table
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . $row["Nome"] . "</td>";
  echo "<td>" . $row["Codigo"] . "</td>";
  echo "<td>" . $row["Descricao"] . "</td>";
  echo "<td>" .number_format($row["Preco"], 2, ',', '.'). "</td>";
  echo "<td><a href='editar.php?ID=" . $row["ID"] . "'>Editar</a> | <a href='excluir.php?ID=" . $row["ID"] . "'>Excluir</a></td>";
  echo "</tr>";
}

mysqli_close($conn);
?>
</table>
<a href='index.html'><button class="btn-voltar" type='button'>Voltar</button></a>
</div>
</body>
</html>