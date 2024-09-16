<?php
// Incluir o arquivo de conexão
include 'conexao.php'; // ou use require 'conexao.php';

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a exclusão do usuário
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir o usuário: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de usuário não encontrado!";
}

$conn->close();

// Redireciona de volta para a lista de usuários após a exclusão
header("Location: listar_usuarios.php");
exit();
?>
