
<?php
$arquivoCSV = __DIR__.'/database/request-list.csv';

function atualizarValorNoCSV($arquivoCSV, $busca, $novoValor) {
    $linhas = file($arquivoCSV); // Lê o arquivo CSV em um array de linhas

    foreach ($linhas as &$linha) {
        $campos = str_getcsv($linha); // Divide a linha em campos
        if ($campos[0] === $busca) { // Verifica se o primeiro campo é igual à busca
            $campos[2] = $novoValor;
            $linha = '"' . $campos[0] . '",' . $campos[1] . ', ' . $campos[2] . "\n"; // Reconstroi a linha com os campos atualizados
        }
    }

    // Reescreve o arquivo CSV com as linhas atualizadas
    file_put_contents($arquivoCSV, implode('', $linhas));
}

// Utilize a função para atualizar o valor no arquivo CSV
$busca = 'Hamburguer'; // O valor a ser procurado na primeira coluna
$novoValor = 3; // O novo valor para substituir na segunda coluna
atualizarValorNoCSV($arquivoCSV, $busca, $novoValor);

echo "O valor foi atualizado com sucesso!";
?>






