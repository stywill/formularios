<?php

$tabuada = 5;
for ($i = 0; $i <= 10; $i++) {
    $resultado = $tabuada * $i;
    echo "$tabuada x $i = $resultado<br>";
}
echo "<br>";

$peso = 80;
$altura = 1.80;
$imc = number_format(($peso / ($altura ** 2)), 2);

echo "Peso: $peso<br>";
echo "Altura: $altura<br>";
echo "IMC: $imc<br>";
if ($imc < 17) {
    echo "Muito abaixo do peso<br>";
}elseif($imc > 17 && $imc<18.49) {
     echo "Abaixo do peso<br>";
}elseif($imc >= 18.5 && $imc<=24.99){
    echo "Peso normal<br>";
}elseif($imc >= 25 && $imc<=29.99){
    echo "Acima do peso<br>";
}elseif($imc >= 30 && $imc<=34.99){
    echo "Obesidade I<br>";
}elseif($imc >= 35 && $imc<=39.99){
    echo "Obesidade II (severa)<br>";
}else{
    echo "Obesidade III (mórbida)<br>";
}
/*
Abaixo de 17	Muito abaixo do peso
Entre 17 e 18,49	Abaixo do peso
Entre 18,5 e 24,99	Peso normal
Entre 25 e 29,99	Acima do peso
Entre 30 e 34,99	Obesidade I
Entre 35 e 39,99	Obesidade II (severa)
Acima de 40	Obesidade III (mórbida)
 *  */