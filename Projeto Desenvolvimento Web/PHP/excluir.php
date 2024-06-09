<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Ingresso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 16px;
        }
        a {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border-radius: 5px;
        }
        a.excluir {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h1>Excluir Ingresso</h1>
    <?php
    include 'conexao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Se confirmado, exclua o ingresso aqui
        $id = $_GET['id'];
        $sql = "DELETE FROM ingressos WHERE id='$id'";
        
        if ($conn->query($sql) === TRUE) {
            echo '<p>Ingresso excluído com sucesso.</p>';
            echo '<a href="listar.php">Retornar para lista</a>';
        } else {
            echo '<p>Erro ao excluir ingresso: ' . $conn->error . '</p>';
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT i.id, u.nome, i.partida FROM ingressos i JOIN usuarios u ON i.usuario_id = u.id WHERE i.id='$id'";
        $result = $conn->query($sql);
        $ingresso = $result->fetch_assoc();
        if ($ingresso) {
            echo '<p>Tem certeza de que deseja excluir o ingresso de <strong>' . $ingresso['nome'] . '</strong> para a partida <strong>' . $ingresso['partida'] . '</strong>?</p>';
            echo '<a href="excluir.php?id=' . $ingresso['id'] . '&confirm=true">Sim</a>';
            echo '<a href="listar.php" class="excluir">Não</a>';
        } else {
            echo '<p>Ingresso não encontrado.</p>';
        }
    } else {
        echo '<p>Parâmetros inválidos.</p>';
    }

    ?>
</body>
</html>
