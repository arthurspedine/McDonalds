<?php

$fileRequests = __DIR__.'/../database/requests.csv';
$rows = readFileToArray($fileRequests);
$fileList = __DIR__.'/../database/request-list.csv';
$fL = readFileToArray($fileList);

if (ifExists(0, $key) || ifExists(1, $key)){
    foreach($rows as $row){
        if ($row['code'] == $key || $row['product'] == $key){
            $a = $row['product'];
        }
    }
    foreach ($fL as $linha) { // * VERIFICAR SE JA EXISTE O PEDIDO!
        if ($linha['code'] == $a){
        $exit = true;
            while ($exit == true) { 
                $key = NULL;
                print_r("Produto já está na lista de pedidos!". PHP_EOL);
                print_r("Digite 'voltar' para cancelar ou altere a quantia que deseja: ");
                $qnt = stream_get_line(STDIN, 1024, PHP_EOL);
                    
                switch ($qnt){
                    case is_numeric($qnt):
                        if ($qnt >= 1){
                            attRequestList($fileList, $a, $qnt);
                            $exit = false;
                        } else{
                            print_r("Valor inválido". PHP_EOL);
                            break;
                        }
                        
                    case 'voltar':
                        $exit = false;
                    default:
                        print_r("Valor inválido!" . PHP_EOL);
                    break;
                }                
            }
        }    
    }
        
    while ($key != NULL){ // * CRIAR O PEDIDO!
        print_r("Digite a quantia que deseja ou 'voltar' para cancelar o pedido: ");
        $qnt = stream_get_line(STDIN, 1024, PHP_EOL);
        if (is_numeric($qnt) && $qnt >= 1){
            
            $line = [];
            foreach($rows as $row){
                if ($row['code'] == $key){
                    $type = $row['product'];
                    $value = $row['value'];
                    $line = '"'.$type.'",'.$value.' , '.$qnt.PHP_EOL;
                    file_put_contents($fileList, $line, FILE_APPEND);
                    print_r($line);
                    $key = NULL;
                    $exit = false;
                }
            }
        } elseif (strtolower($qnt) == "voltar"){
            $key = NULL;
            $exit = false;
        } else {
            print_r("Valor inválido!" . PHP_EOL);
        }
    }
} else {
    print_r("Valor inválido!" . PHP_EOL);
}

?>