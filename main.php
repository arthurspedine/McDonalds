<?php
// * Verificar se ja existe o pedido no arquivo, feito mas precisa arrumar o quantia
// TODO: Finalizar o 'pagamento com a soma'
// TODO: Fazer opção de retirar o pedido da lista

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
        print_r("Digite o código ou nome / produto ou 'finalizar' para finalizar seu pedido: ");
        $key = stream_get_line(STDIN, 1024, PHP_EOL);
        print_r(PHP_EOL);

        switch ($key){
            case is_numeric($key):
                include 'options/make-request.php';
            break;
            case 'finalizar':
                include 'options/end-request.php';
            break;
            default:
                print_r("Valor inválido!" . PHP_EOL);
            break;
        }
    }else{
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