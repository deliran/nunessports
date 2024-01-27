
<?php
include 'conexao.php';

// Chama a função para conectar ao banco de dados
$conn = conectarBanco();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos do formulário existem
    if (isset($_POST['nome']) && isset($_POST['codigo']) && isset($_POST['descricao']) && isset($_POST['preco'])) {
        // Obtém os dados do formulário
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
        $preco = mysqli_real_escape_string($conn, $_POST['preco']);

        // Query SQL preparada
        $sql = "INSERT INTO produtos (Nome, Codigo, Descricao, Preco) VALUES (?, ?, ?, ?)";
        
        // Preparar a declaração
        $stmt = mysqli_prepare($conn, $sql);

        // Vincular parâmetros
        mysqli_stmt_bind_param($stmt, "sssd", $nome, $codigo, $descricao, $preco);

        // Executar a declaração
        if (mysqli_stmt_execute($stmt)) {
            echo "Registro inserido com sucesso! Redirecionando para página de cadastro...";
            // Redirecionar para a página de cadastro após 3 segundos
            header("Refresh: 3; URL=formulario.php");
            exit();
        } else {
            echo "Falha ao inserir o registro: " . mysqli_error($conn);
        }

        // Fechar a declaração
        mysqli_stmt_close($stmt);
    } else {
        echo "Campos do formulário não estão presentes.";
    }
} else {
    echo "Requisição inválida.";
}

// Fechar a conexão
mysqli_close($conn);
?>
