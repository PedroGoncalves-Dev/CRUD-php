<?php
// Incluir o arquivo de conexão
include 'conexao.php'; // ou use require 'conexao.php';

// Consultar os usuários no banco de dados
$sql = "SELECT id, nome, email, criado_em FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }
        table {
            width: 80%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 5px 10px;
            border-radius: 5px;
        }
        a.excluir {
            background-color: #f44336;
        }
        #novoCad {
            margin-top: 20px
        }
    </style>
</head>
<body>
    
    <h2>Lista de Usuários</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nome"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["criado_em"] . "</td>";
                echo "<td>
                        <a href='editar_usuario.php?id=" . $row["id"] . "'>Editar</a> | 
                        <a href='excluir_usuario.php?id=" . $row["id"] . "' class='excluir' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");'>Excluir</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum usuário encontrado</td></tr>";
        }

        $conn->close();
        ?>
    </table>
    <a href="index.html" id='novoCad'>Cadastrar novo usuario</a>
</body>
</html>
