<?php

function readFromCSVFile($filePath) {
    $products = [];
    $fp = fopen($filePath, "r");
    $keys = fgetcsv($fp); 
    while (($data = fgetcsv($fp)) !== false) {
        
        $product = array_combine($keys, $data);
        $product['name'] = strtoupper(str_replace("'", "", $product['name']));

        $product['hash'] = md5($product['id'] . $product['name']);
        $product['availability'] = match($product['qty']){
            0 => "Esaurito",
            1,2,3,4,5, => "Scarsa",
            default => "Buona"
        };
        $products[] = $product;
    }
    fclose($fp);
    return $products;
}



$filePath = "data.txt";
$products = readFromCSVFile($filePath);

//print_r($products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <style>
        th   {background-color: lightgray;}
        h1   {background-color: lightblue;}
        table{border: 2px solid black;}
        tr   {border: 1px solid black;}
        td   {border: 1px solid black;}
    </style>
</head>
<body>
    <h1>Products Page</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Availability</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name'];?></td>
                <td><?php echo $product['qty']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['availability']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>