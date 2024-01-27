<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Cadastro de Produtos</title>
<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>

    <div class="form_cd">
      <h2>Formulário de Cadastro de Produto</h2>
       <form method="POST" action="processa_formulario.php">
        <div><label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" placeholder="Nome" required></div>

        <div><label for="codigo">Código:</label>
        <input type="number" id="codigo" name="codigo"  placeholder="Códigor" required></div>
        
        <div><label for="descricao">Descrição:</label>
        <textarea type="text" id="descricao" name="descricao" placeholder="Descrição" required></textarea></div>
        
        <div><label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" placeholder="Preço" required></div>

        <div><input type="submit" value="Cadastrar"></div>
        <div><a href="index.html"><button class="btn-voltar" type='button'>Voltar</button></a></div>
    </form>
    </div>
</body>
</html>