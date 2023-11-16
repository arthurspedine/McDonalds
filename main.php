<?php

// TODO: CORRIGIR A TABELA DE LISTAGEM PARA PALAVRAS MAIORES
// TODO: Palavras grandes nos pedidos
include 'functions.php';

$exit = false;

$fileRequests = __DIR__.'/database/requests.csv';
$fileList = __DIR__.'/database/request-list.csv';

$lista = [];
startRequest();
while($exit==false){

    print_r(PHP_EOL);
    print_r('| ------------------------------------------------- |'. PHP_EOL);
    print_r("|              Bem Vindo ao McDonald's              |". PHP_EOL);
    print_r('| ------------------------------------------------- |'. PHP_EOL);
    menuMessage();
    print_r(PHP_EOL);

    if (filesize($fileList) > 0){
        requestList();
        print_r(PHP_EOL);
        print_r("O que deseja fazer agora? Digite o número da opção ".PHP_EOL);
        print_r("1) Adicionar um novo pedido".PHP_EOL);
        print_r("2) Remover um pedido".PHP_EOL);
        print_r("3) Finalizar o pedido".PHP_EOL);
        print_r("4) Cancelar pedido".PHP_EOL);
        $entrada = stream_get_line(STDIN, 1024, PHP_EOL);
        print_r(PHP_EOL);

        switch ($entrada){
            case 1:
                print_r("Digite um nome ou código do produto: ");
                $key = stream_get_line(STDIN, 1024, PHP_EOL);
                include 'options/make-request.php';
            break;
            case 2:
                include 'options/delete-product.php';
            break;
            case 3:
                include 'options/end-request.php';
            break;
            case 4:
                exit;
            break;
            default: 
                ("Valor inválido!".PHP_EOL);
            break;
        }
    }else{ // * CHAT INICIAL
        print_r("'sair' para finalizar a execução do pedido.");
        print_r(PHP_EOL."Para começar seu pedido, digite o código ou nome do produto: ");
        $key = stream_get_line(STDIN, 1024, PHP_EOL);
        print_r(PHP_EOL);
        switch ($key){
            case is_numeric($key):
                include 'options/make-request.php';
            break;
            case 'sair':
                exit;
            break;
            default:
                print_r("Valor inválido!" . PHP_EOL);
            break;

        }
    }  
}



?>