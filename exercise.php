<?php
function readFromCSVFile($filePath) {
    $products = [];
    $fp = fopen($filePath, "r");
    while (($data = fgetcsv($fp)) !== false) {
       
        $products[] = $data;
    }
    fclose($fp);
    return $products; 
}


$filePath = "data.txt";


$products = readFromCSVFile($filePath);


print_r($products);



