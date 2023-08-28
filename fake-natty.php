<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
    $numGP = isset($_POST["num_gp"]) ? intval($_POST["num_gp"]) : 0;
    $numPilotos = isset($_POST["num_pilotos"]) ? intval($_POST["num_pilotos"]) : 0;

    // Processar os resultados das corridas
    for ($i = 1; $i <= $numGP; $i++) 
    {
        echo "<h2>Resultados da Corrida $i:</h2>";
        for ($j = 1; $j <= $numPilotos; $j++) 
        {
            $campoNome = "corrida_$i\_piloto_$j";
            if (isset($_POST[$campoNome])) 
            {
                $resultado = intval($_POST[$campoNome]);
                echo "Na Corrida $i, o Piloto $j chegou na posição $resultado.<br>";
                // Aqui você pode processar os resultados, como armazenar em um banco de dados.
            }
        }
    }

    $numSistemas = isset($_POST["num_sistemas"]) ? intval($_POST["num_sistemas"]) : 0;

    // Processar os sistemas de pontuação
    for ($sistema = 1; $sistema <= $numSistemas; $sistema++) 
    {
        echo "<h2>Sistema de Pontuação $sistema:</h2>";
        $ultimoColocado = isset($POST["ultimo_colocado$sistema"]) ? intval($POST["ultimo_colocado$sistema"]) : 1;
        $pontos = array();
        for ($posicao = 1; $posicao <= $numPilotos; $posicao++) 
        {
            $campoPontos = "pontos_$sistema\_$posicao";
            $pontos[$posicao] = isset($_POST[$campoPontos]) ? intval($_POST[$campoPontos]) : 0;
        }

        // Aqui você pode calcular a pontuação para cada piloto com base no sistema de pontuação.
        // Implemente a lógica apropriada para calcular os pontos.
        // Exemplo de cálculo de pontos:
        $pontuacao = array();
        for ($posicao = 1; $posicao <= $numPilotos; $posicao++) 
        {
            $pontuacao[$posicao] = $pontos[$posicao];
        }

        // Exibir pontuações calculadas
        for ($posicao = 1; $posicao <= $numPilotos; $posicao++) 
        {
            echo "Piloto $posicao: Pontuação = " . $pontuacao[$posicao] . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Resultados de Corrida</title>
</head>
<body>
    <h1>Informe os Resultados das Corridas</h1>
    <form method="post" action="fake-natty.php">
        <label for="num_gp">Número de Grandes Prêmios (G):</label>
        <input type="number" id="num_gp" name="num_gp" min="1" max="100" required>
        <br><br>

        <label for="num_pilotos">Número de Pilotos (P):</label>
        <input type="number" id="num_pilotos" name="num_pilotos" min="1" max="100" required>
        <br><br>

        <?php
        // Gerar campos de entrada dinamicamente para os resultados das corridas
        if (isset($_POST["num_gp"]) && isset($_POST["num_pilotos"])) 
        {
            $numGP = $_POST["num_gp"];
            $numPilotos = $_POST["num_pilotos"];

            for ($i = 1; $i <= $numGP; $i++) 
            {
                echo "<h2>Resultados da Corrida $i:</h2>";
                for ($j = 1; $j <= $numPilotos; $j++) 
                {
                    echo "<label for='corrida_$i\_piloto_$j'>Piloto $j:</label>";
                    echo "<input type='number' id='corrida_$i\_piloto_$j' name='corrida_$i\_piloto_$j' required>";
                    echo "<br>";
                }
            }
        }
        ?>

        <h1>Defina os Sistemas de Pontuação</h1>

        <label for="num_sistemas">Número de Sistemas de Pontuação (S):</label>
        <input type="number" id="num_sistemas" name="num_sistemas" min="1" max="10" required>
        <br><br>

        <?php
        // Gerar campos de entrada dinamicamente para os sistemas de pontuação
        if (isset($_POST["num_sistemas"])) 
        {
            $numSistemas = $_POST["num_sistemas"];

            for ($sistema = 1; $sistema <= $numSistemas; $sistema++) 
            {
                echo "<h2>Sistema de Pontuação $sistema:</h2>";
                echo "<label for='ultimo_colocado_$sistema'>Último Colocado:</label>";
                echo "<input type='number' id='ultimo_colocado_$sistema' name='ultimo_colocado_$sistema' min='1' max='$numPilotos' required>";
                echo "<br>";

                echo "<label for='pontos_$sistema'>Pontos:</label>";
                for ($posicao = 1; $posicao <= $numPilotos; $posicao++) 
                {
                    echo "<input type='number' id='pontos_$sistema\_$posicao' name='pontos_$sistema\_$posicao' required>";
                }
                echo "<br><br>";
            }
        }
        ?>

        <input type="submit" value="Calcular Pontuações">
    </form>
</body>
</html>