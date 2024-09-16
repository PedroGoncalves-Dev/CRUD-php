<?php
include 'conexao.php';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Prepara a consulta SQL
    $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nome, $email);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
        header("Location: listar_usuarios.php"); // Redireciona de volta para a lista de usuários
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
