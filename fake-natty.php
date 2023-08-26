<?php
//Verificação para ver se o método de solicitação HTTP é POST
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    //Obter o número de grandes prêmios $G e número de pilotos $P
    $G = isset($_POST["G"]) ? intval($_POST["G"]) : 0;
    $P = isset($_POST["P"]) ? intval($_POST["P"]) : 0;

    $pontuacao_atual = array_fill(1, $P, 0);
    $S = isset($_POST["S"]) ? intval($_POST["S"]) : 0;
    $campeoes = array();

    for ($i = 0; $i < $G; $i++) 
    {
        $ordem_chegada = isset($_POST["corrida$i"]) ? $_POST["corrida$i"] : array();
        for ($j = 0; $j < $P; $j++) 
        {
            $piloto = isset($ordem_chegada[$j]) ? intval($ordem_chegada[$j]) : 0;
            $pontuacao_atual[$piloto] += $j;
        }
    }

    for ($sistema = 0; $sistema < $S; $sistema++) 
    {
        $K = isset($_POST["K$sistema"]) ? intval($_POST["K$sistema"]) : 0;
        $pontos = isset($_POST["pontos$sistema"]) ? $_POST["pontos$sistema"] : array();
        for ($j = 0; $j < $K; $j++) 
        {
            $pontos[] = intval($_POST["pontos$sistema$j"]);
        }

        $pontuacao_total = array();
        for ($piloto = 1; $piloto <= $P; $piloto++) 
        {
            $pontuacao_total[$piloto] = $pontuacao_atual[$piloto];
        }

        arsort($pontuacao_total);

        $max_pontos = reset($pontuacao_total);
        $campeao = key($pontuacao_total);

        if ($pontuacao_total[$campeao] == end($pontuacao_total)) 
        {
            $campeoes[] = $campeao;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campeão Mundial de Pilotos</title>
</head>
<body>
    <h1>Campeão Mundial de Pilotos</h1>
    <form method="post">
        <label for="G">Número de Grandes Prêmios:</label>
        <input type="number" name="G" id="G" required>
        <br>
        <label for="P">Número de Pilotos:</label>
        <input type="number" name="P" id="P" required>
        <br>

        <?php
        for ($i = 0; $i < $G; $i++) 
        {
            echo "<h2>Resultado da Corrida " . ($i + 1) . "</h2>";
            for ($j = 1; $j <= $P; $j++) 
            {
                echo "Posição do Piloto " . $j . ": ";
                echo "<input type='number' name='corrida$i" . "[]' required>";
                echo "<br>";
            }
        }
        ?>

        <label for="S">Número de Sistemas de Pontuação:</label>
        <input type="number" name="S" id="S" required>
        <br>

        <?php
        for ($sistema = 0; $sistema < $S; $sistema++) 
        {
            echo "<h2>Sistema de Pontuação " . ($sistema + 1) . "</h2>";
            echo "Último piloto que recebe pontos: ";
            echo "<input type='number' name='K$sistema' required>";
            echo "<br>";

            for ($j = 1; $j <= $K; $j++) 
            {
                echo "Pontos para o Piloto " . $j . ": ";
                echo "<input type='number' name='pontos$sistema" . "[]' required>";
                echo "<br>";
            }
        }
        ?>

        <input type="submit" value="Calcular Campeão">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") 
    {
        if (count($campeoes) === 1) 
        {
            echo "<h2>Campeão Mundial de Pilotos:</h2>";
        } else 
        {
            echo "<h2>Campeões Mundiais de Pilotos:</h2>";
        }
        echo implode(" ", $campeoes);
    }
    ?>
</body>
</html>
