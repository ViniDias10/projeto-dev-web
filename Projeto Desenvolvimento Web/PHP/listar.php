<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Ingressos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .action-buttons a {
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .action-buttons a:hover {
            background-color: #0056b3;
        }
        .action-buttons .delete {
            background-color: #dc3545;
        }
        .action-buttons .delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Seus ingressos</h1>
    <?php
    include 'conexao.php';

    $sql = "SELECT u.nome, u.email, u.cpf, u.telefone, i.id as ingresso_id, i.partida, i.arq_inteira, i.arq_meia, i.vip_inteira, i.vip_meia, i.valor_total 
            FROM usuarios u 
            JOIN ingressos i ON u.id = i.usuario_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Partida</th>
                    <th>Arquibancada Inteira</th>
                    <th>Arquibancada Meia</th>
                    <th>VIP Inteira</th>
                    <th>VIP Meia</th>
                    <th>Valor Total</th>
                    <th>Ações</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["nome"]. "</td>
                    <td>" . $row["email"]. "</td>
                    <td>" . $row["cpf"]. "</td>
                    <td>" . $row["telefone"]. "</td>
                    <td>" . $row["partida"]. "</td>
                    <td>" . $row["arq_inteira"]. "</td>
                    <td>" . $row["arq_meia"]. "</td>
                    <td>" . $row["vip_inteira"]. "</td>
                    <td>" . $row["vip_meia"]. "</td>
                    <td>R$" . $row["valor_total"]. "</td>
                    <td class='action-buttons'>
                        <a href='editar.php?id=" . $row["ingresso_id"]. "'>Editar</a>
                        <a class='delete' href='excluir.php?id=" . $row["ingresso_id"]. "'>Excluir</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum ingresso encontrado.";
    }

    ?>
</body>
</html>
