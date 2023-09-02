<?php 

print_r(PHP_EOL);


print_r('| ------------------------------------------------- |'. PHP_EOL);
print_r("|         Opção escolhida: Remover Produto          |". PHP_EOL);
print_r('| ------------------------------------------------- |'. PHP_EOL);

menuMessage();
print_r(PHP_EOL);

print_r("Digite o código do produto que deseja retirar: ");
$entrada = stream_get_line(STDIN, 1024, PHP_EOL);
while (removeLine($entrada) == false){
    print_r("Digite o código do produto que deseja retirar: ");
    $entrada = stream_get_line(STDIN, 1024, PHP_EOL);
}

?>