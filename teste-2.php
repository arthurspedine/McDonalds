<?php
include 'functions.php';
function some(){
    $filePath = __DIR__.'/database/request-list.csv';
    $lines = readFileToArray($filePath);

    $total = 0.0;

    foreach($lines as $row){
        $total = $total + ($row['product'] * $row['value']);
    }
    $totalForm = number_format($total,2, '.', '');
    $totalFormated = str_pad($totalForm, 8, ' ', STR_PAD_RIGHT);

    print_r("|---------------------------------------------------|".PHP_EOL);
    print_r("|   Total: |      ".$totalFormated."   |                      |  ".PHP_EOL);
    print_r("|---------------------------------------------------|".PHP_EOL);

}
some();
?>