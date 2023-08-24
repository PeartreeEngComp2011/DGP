<?php

$x = 0;
$y = 1;

echo "<b>Os primeiros 40 númeors da série de Fibonacci são: </b><br><br>";

for($e = 0; $e < 40; $e++)
{
    echo $x. "<br>";

    //Calculando o próximo número da sequência
    $proxNum = $x + $y;

    //Atualizando os valores para os próximos cálculos
    $x = $y;
    $y = $proxNum;
}

?>