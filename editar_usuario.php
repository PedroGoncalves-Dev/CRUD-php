<?php
// Incluir o arquivo de conexão
include 'conexao.php'; // ou use require 'conexao.php';

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do usuário que será editado
    $sql = "SELECT nome, email FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($nome, $email);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "ID de usuário não encontrado!";
    exit;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualiza os dados do usuário no banco de dados
    $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nome, $email, $id);

    if ($stmt->execute()) {
        echo "Usuário atualizado com sucesso!";
        header("Location: listar_usuarios.php");
        exit();
    } else {
        echo "Erro ao atualizar o usuário: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .containerEditar {
            background: #ccc;
            width: 40%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            padding: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .opcoes {
            width: 40%;
            display: flex;
            justify-content: space-around;
            padding: 30px 0px;
        }
        .opcoes a {
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .opcoes a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="containerEditar">
        <h2>Editar Usuário</h2>
        
        <form action="" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            
            <input type="submit" value="Atualizar">
        </form>
    </div>

    <div class="opcoes">
        <a href="index.html">Cadastrar novo usuário</a>
        <a href="listar_usuarios.php">Ver lista de usuários</a>
    </div>
</body>
</html>
