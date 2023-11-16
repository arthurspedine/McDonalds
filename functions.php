<?php

function readFloat($instructions){
    $floatTyped = null;
    $checkIsFloat = false;

    while ($floatTyped == null){
        print_r($instructions);
        $floatTyped = stream_get_line(STDIN, 1024, PHP_EOL);

        $checkIsFloat = filter_var($floatTyped, FILTER_VALIDATE_FLOAT);

        if ($checkIsFloat == false){
            print_r("O valor digitado deve ser um número decimal!" . PHP_EOL);
            print_r("Siga o exemplo: 5.90");
            $floatTyped == null;
        }
    }
    return $floatTyped;
}

function readString($instructions){
    print_r($instructions);
    return stream_get_line(STDIN, 1024, PHP_EOL);
}

function readInt($instructions) {
    while (true) {
        print_r($instructions);
        $numero = stream_get_line(STDIN, 1024, PHP_EOL);
        
        if (strlen($numero) < 3 || !is_numeric($numero)) {
            print_r("Digite um número válido e com pelo menos 3 dígitos!".PHP_EOL);
            print_r("Siga o exemplo: 001".PHP_EOL);
        } else {
            return $numero;
        }
    }
}

function readFileToArray($filePath){
    $lines = [];

    $recipesArray = file($filePath);

    foreach($recipesArray as $line){
        $lineArray = str_getcsv($line);

        $lines[] = [
            'code' => $lineArray[0],
            'product' => $lineArray[1],
            'value' => $lineArray[2],
        ];
    }
    return $lines;
}

function ifExists($key, $code){
    try {
        $handle = fopen(__DIR__.'/database/requests.csv', 'r');
        if ($handle !== false){
            while(($row = fgetcsv($handle)) !== false){
                if (!empty($row) && $row[$key] == $code){
                    fclose($handle);
                    return true;
                }
            }
            fclose($handle);
        }
        return false;
    } catch (Exception $e) {
        echo "Erro!";
        return false;
    } 
}

function format($value){  
    if (is_numeric($value)){
        return number_format($value, 2, ".", " ");
    } else {
        return readFloat($value);
    }
}
function startRequest(){
    $filePath = __DIR__.'/database/request-list.csv';
    $fileHandle = fopen($filePath, "w");
    if ($fileHandle){

        fwrite($fileHandle, '');

        fclose($fileHandle);
    } else {
        print_r("O arquivo não foi encontrado!");
    }
}
function removeLine($key) {
    $linhas = file(__DIR__.'/database/requests.csv');
    
    // Verifica se a chave existe
    $keyExists = false;
    foreach ($linhas as $linha) {
        $dados = str_getcsv($linha);
        if ($dados[0] === $key) {
            $keyExists = true;
            break;
        }
    }

    if (!$keyExists) {
        print_r("Produto não encontrado!");
        print_r(PHP_EOL);
        return false;
    }

    $handle = fopen(__DIR__.'/database/requests.csv', "w");
    $deletedHandle = fopen(__DIR__.'/database/deleted-requests.csv', "a");

    foreach ($linhas as $linha) {
        $dados = str_getcsv($linha);
        if ($dados[0] !== $key) {
            fwrite($handle, $linha);
        } else {
            print_r(PHP_EOL);
            print_r("A produto do código ".$key." foi removido! Se quiser \nrecupera-la, vá para o arquivo deleted-requests.csv".PHP_EOL);
            fwrite($deletedHandle, $linha);
        }
    }
    print_r("Linha removida com sucesso!". PHP_EOL);
    fclose($handle);
    fclose($deletedHandle);
    return true;
}

function menuMessage(){
    print_r("|     CÓDIGO    |      PRODUTO      |    VALORES    |". PHP_EOL);
    
    
    $fileRequests = __DIR__.'/database/requests.csv';

    $requests = readFileToArray($fileRequests);

    foreach($requests as $row){

        $code = str_pad($row['code'], 8, ' ', STR_PAD_RIGHT);
        $type = str_pad($row['product'], 14, ' ', STR_PAD_RIGHT);
        $value = str_pad($row['value'], 10, ' ', STR_PAD_RIGHT);

        print_r('|      '.$code.' |     '.$type.'|    '.$value.' | '.PHP_EOL);

    }
}

function requestList(){
    print_r("|--------------|  LISTA DOS PEDIDOS  |--------------|". PHP_EOL);
    print_r("|  Quantidade  |      Produto(s)     |   Valor(es)  |". PHP_EOL);

    $fileRequests = __DIR__.'/database/request-list.csv';
    $requests = readFileToArray($fileRequests);

    foreach($requests as $row){

        $qnt = str_pad($row['code'], 6, ' ', STR_PAD_RIGHT);
        $type = str_pad($row['product'], 10, ' ', STR_PAD_RIGHT);
        $value = str_pad($row['value'], 9, ' ', STR_PAD_RIGHT);

        print_r('|      '.$qnt.'  |     '.$type.'      |    '.$value.' | '.PHP_EOL);
    }
}

function attRequestList($file, $search, $key){
    $lines = file($file); 

    foreach ($lines as &$line){
        $rows = str_getcsv($line);
        if ($rows[1] === $search){
            $rows[0] = $key;
            $line = $rows[0] . ', "' . $rows[1] . '",' . $rows[2] . "\n";
        }
    }
    file_put_contents($file, implode('', $lines));
}

function add(){
    $filePath = __DIR__.'/database/request-list.csv';
    $lines = readFileToArray($filePath);

    $total = 0.0;

    foreach($lines as $row){
        $total = $total + ($row['code'] * $row['value']);
    }
    $totalForm = number_format($total,2, '.', '');
    $totalFormated = str_pad($totalForm, 9, ' ', STR_PAD_RIGHT);

    if (strlen($totalForm) < 5){
        print_r("|---------------------------------------------------|".PHP_EOL);
        print_r("|   Total:     |        ".$totalFormated."    |              |  ".PHP_EOL);
        print_r("|---------------------------------------------------|".PHP_EOL);
    } else {
        print_r("|---------------------------------------------------|".PHP_EOL);
        print_r("|   Total:     |       ".$totalFormated."     |              |  ".PHP_EOL);
        print_r("|---------------------------------------------------|".PHP_EOL);
    }
}

// ! DELETE PART

function exist($key, $code){
    try {
        $handle = fopen(__DIR__.'/database/request-list.csv', 'r');
        if ($handle !== false){
            while(($row = fgetcsv($handle)) !== false){
                if (!empty($row) && $row[$key] == $code){
                    fclose($handle);
                    return true;
                }
            }
            fclose($handle);
        }
        return false;
    } catch (Exception $e) {
        echo "Erro!";
        return false;
    } 
}


function rLine($key){
    $linhas = file(__DIR__.'/database/request-list.csv');
    
    // Verifica se a chave existe
    $keyExists = false;
    foreach ($linhas as $linha) {
        $dados = str_getcsv($linha);
        if ($dados[1] === $key) {
            $keyExists = true;
            break;
        }
    }

    $handle = fopen(__DIR__.'/database/request-list.csv', "w");

    foreach ($linhas as $linha) {
        $dados = str_getcsv($linha);
        if ($dados[1] !== $key) {
            fwrite($handle, $linha);
        }
    }
    print_r("Pedido removido com sucesso!". PHP_EOL);
    fclose($handle);
    return true;
}

?>