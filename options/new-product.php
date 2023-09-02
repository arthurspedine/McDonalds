<?php

print_r(PHP_EOL);

print_r('| ------------------------------------------------- |'. PHP_EOL);
print_r("|        Opção escolhida: Cadastrar Produto         |". PHP_EOL);
print_r('| ------------------------------------------------- |'. PHP_EOL);

print_r(PHP_EOL);

print_r("Informe o código, produto e valor.".PHP_EOL);

$code = readInt("Digite o código do produto: ");
while (ifExists(0, $code)){
    print_r("Digite um código que não foi usado!".PHP_EOL);
    $code = readInt("Digite o código do produto: ");
}

$type = readString("Digite o nome do produto: ");
while (ifExists(1, $type)){
    print_r("Digite um nome de produto que não foi usado!". PHP_EOL);
    $type = readString("Digite o nome do produto: ");
}

$price = readFloat("Digite o valor do produto: ");
$value = format($price);


$line = $code.', "'.$type.'", '.$value.PHP_EOL;
$fileRequests = __DIR__.'/../database/requests.csv';

file_put_contents($fileRequests, $line, FILE_APPEND);

print_r(PHP_EOL);

print_r("### PRODUTO REGISTRADO COM SUCESSO! ###". PHP_EOL);
print_r(PHP_EOL);
?>