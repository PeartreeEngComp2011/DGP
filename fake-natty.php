<!DOCTYPE html>
<html>
<head>
    <title>Calculadora do Campeão Mundial de Pilotos da Fórmula 1</title>
</head>
<body>
    <h1>Calculadora do Campeão Mundial de Pilotos da Fórmula 1</h1>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="grandes-premios">Número de Grandes Prêmios:</label>
        <input type="number" id="grandes-premios" name="grandes-premios" required><br>

        <label for="pilotos">Número de Pilotos:</label>
        <input type="number" id="pilotos" name="pilotos" required><br>

        <?php
        // Verifica se o formulário foi enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $grandesPremios = $_POST["grandes-premios"];
            $pilotos = $_POST["pilotos"];

            echo "<h2>Insira os resultados das corridas:</h2>";

            // Loop para inserir os resultados das corridas
            for ($i = 1; $i <= $grandesPremios; $i++) {
                echo "<h3>Grande Prêmio $i:</h3>";
                for ($j = 1; $j <= $pilotos; $j++) {
                    echo "Posição do Piloto $j no Grande Prêmio $i: <input type='number' name='corrida-$i-piloto-$j' required><br>";
                }
            }
        }
        ?>

        <input type='submit' value='Calcular Campeão'>
    </form>

    <?php
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Processamento dos resultados para determinar o campeão
        $melhorPontuacao = 0;
        $campeoes = [];

        // Loop para calcular a pontuação de cada piloto
        for ($p = 1; $p <= $pilotos; $p++) {
            $pontuacao = 0;

            for ($g = 1; $g <= $grandesPremios; $g++) {
                $posicao = $_POST["corrida-$g-piloto-$p"];

                // Implemente aqui o cálculo da pontuação com base na posição da corrida e no sistema de pontuação desejado
                // Por exemplo, você pode usar a função calcularPontuacao($posicao, $g) para calcular a pontuação

                // Aqui você pode adicionar diferentes sistemas de pontuação, como 2010 ou 2003
                $pontuacao += calcularPontuacao($posicao, $g);
            }

            // Verifica se este piloto é o novo campeão
            if ($pontuacao > $melhorPontuacao) {
                $melhorPontuacao = $pontuacao;
                $campeoes = [$p];
            } elseif ($pontuacao == $melhorPontuacao) {
                $campeoes[] = $p;
            }
        }

        echo "<h2>Campeão Mundial de Pilotos:</h2>";
        echo "<p>Piloto(s) Campeão(s): " . implode(", ", $campeoes) . "</p>";
    }

    // Função para calcular a pontuação com base na posição da corrida e no sistema de pontuação
    function calcularPontuacao($posicao, $grandePremio) {
        // Aqui você pode implementar diferentes sistemas de pontuação
        // Por exemplo, o sistema de 2010 e 2003

        // Sistema de Pontuação de 2010
        $pontuacao2010 = [25, 18, 15, 12, 10, 8, 6, 4, 2, 1];

        // Sistema de Pontuação de 2003
        $pontuacao2003 = [10, 8, 6, 5, 4, 3, 2, 1];

        // Escolha qual sistema de pontuação usar com base no grande prêmio
        if ($grandePremio <= 10) {
            return $pontuacao2010[$posicao - 1];
        } else {
            return $pontuacao2003[$posicao - 1];
        }
    }
    ?>
</body>
</html>