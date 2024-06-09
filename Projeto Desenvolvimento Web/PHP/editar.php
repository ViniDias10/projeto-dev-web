<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ingresso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Editar Ingresso</h1>
    <?php
    include 'conexao.php';

    $id = $_GET['id']; // ID do ingresso a ser editado

    $sql = "SELECT * FROM ingressos WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
        <form action="atualizar.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="partida">Partida:</label>
            <input type="text" id="partida" name="partida" value="<?php echo $row['partida']; ?>" required><br>
            <label for="arqInteira">Arquibancada Inteira:</label>
            <input type="number" id="arqInteira" name="arqInteira" value="<?php echo $row['arq_inteira']; ?>" required><br>
            <label for="arqMeia">Arquibancada Meia:</label>
            <input type="number" id="arqMeia" name="arqMeia" value="<?php echo $row['arq_meia']; ?>" required><br>
            <label for="vipInteira">VIP Inteira:</label>
            <input type="number" id="vipInteira" name="vipInteira" value="<?php echo $row['vip_inteira']; ?>" required><br>
            <label for="vipMeia">VIP Meia:</label>
            <input type="number" id="vipMeia" name="vipMeia" value="<?php echo $row['vip_meia']; ?>" required><br>
            <input type="submit" value="Atualizar">
        </form>
    <?php
    } else {
        echo "Ingresso não encontrado.";
    }


    ?>
</body>
</html>
