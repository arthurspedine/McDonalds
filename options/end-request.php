<?php
$exit = true;
while($exit = true){
    requestList();
    soma();
    print_r("Finalizar compra? s/n : ");
    $r = stream_get_line(STDIN, 1024, PHP_EOL);
    switch ($r){
        case 's':
            print_r("Compra finalizada com sucesso!". PHP_EOL);
            exit;
        case 'n':
            print_r("Compra cancelada!");
            exit;
        default:
            print_r("Opção inválida!");
            $exit = true;
    }
}


?>