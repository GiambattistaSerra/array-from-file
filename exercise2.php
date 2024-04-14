<?php

function readFromCSVFile($filePath) {
    $products = [];
    $fp = fopen($filePath, "r");
    $keys = fgetcsv($fp); 
    while (($data = fgetcsv($fp)) !== false) {
        
        $product = array_combine($keys, $data);
        $products[] = $product;
    }
    fclose($fp);
    return $products;
}

$filePath = "data.txt";
$products = readFromCSVFile($filePath);
print_r($products);
