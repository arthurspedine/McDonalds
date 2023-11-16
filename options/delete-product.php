<?php

print_r(PHP_EOL);

requestList();

$e = false;
while ($e == false){
    $key = readString("Digite um nome do produto que deseja remover de \nsua lista ou 'voltar' para voltar: ");
    print_r(PHP_EOL);
    if ($key == 'voltar'){
        $e = true;
    } elseif (exist(1, $key)){
        rLine($key);
        print_r(PHP_EOL);
        $e = true;
    } else {
        print_r("Código não encontrado! Digite novamente ou 'voltar' para voltar"); 
        // * FAZER UMA VERIFICAÇÃO DE
        // * SE DIGITA O $KEY, VAI PEGAR O CÓDIGO, ABRIR O REQUESTS.CSV E O NOME DO PRODUTO
        // * SE E COMPARAR SE TEM O PRODUTO NA REQUEST-LIST.CSV 
        print_r(PHP_EOL);
    }
}


?>