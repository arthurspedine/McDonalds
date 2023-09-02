<?php

include 'functions.php';

$exit = false;



while($exit == false){
    print_r(PHP_EOL);

    print_r('| ------------------------------------------------- |'. PHP_EOL);
    print_r("|              Bem Vindo ao McDonald's              |". PHP_EOL);
    print_r("|            Esta é aba de ADMINISTRADOR            |". PHP_EOL);
    print_r('| ------------------------------------------------- |'. PHP_EOL);
    
    menuMessage();

    print_r(PHP_EOL. "O que deseja fazer?");

    print_r(PHP_EOL);

    print_r("1) Cadastrar Produto " . PHP_EOL);
    print_r("2) Retirar Produto " . PHP_EOL);
    print_r("3) Sair " . PHP_EOL);

    print_r(PHP_EOL);

    $option = stream_get_line(STDIN, 1024, PHP_EOL);

    switch($option){
        case 1:
            include 'options/new-product.php';
        break;
        case 2:
            include 'options/del-product.php';
        break;
        case 3:
            $exit = true;
        break;
        default:
            print_r("Opção inválida!". PHP_EOL);
        break;
    }

}
?>