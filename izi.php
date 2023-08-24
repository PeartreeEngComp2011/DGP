<?php

for($d = 1; $d <=50; $d++)
{
    //Verificar se o número é múltiplo de 3 e 5
    if($d % 3 == 0 && $d % 5 ==0)
    {
        echo "FizzBuzz<br>";
    }
    //Verificar se o número é múltiplo de 3
    elseif ($d % 3 == 0)
    {
        echo "Fizz<br>";
    }
    //Verificar se o número é múltiplo de 5
    elseif ($d % 5 == 0)
    {
        echo "Buzz<br>";
    }
    // Se não for múltiplo de 3 0u 5, imprima o número
    else
    {
        echo $d . "<br>";
    }
}

?>