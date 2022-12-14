<?php
declare(strict_types=1);
//Declare vending machine data base/menu
function createProduct(string $name, int $price): stdClass
{
    $product=new stdClass();
    $product->name = $name;
    $product->price = $price;
    return $product;
}

$menu = [
    createProduct("latte", 100),
    createProduct("cappuccino", 120),
    createProduct("white", 80),
    createProduct("black", 70),
];
//Choose product
echo "Choose product:\n";
echo "0. latte\n";
echo "1. cappuccino\n";
echo "2. white\n";
echo "3. black\n";
(int) $clientChoice = readline("-> ");
//Insert coins
$wallet = 0;
while(true){
    $wallet +=(int) readline("Insert coin(2, 1, 0.50, 0.20, 0.05): ")*100;
    if($wallet > $menu[$clientChoice]->price){
        break;
    }
}
//Counting
$coins = [200, 100, 50, 20, 10, 5];
//array containing amount of each coin value
$coinAmount=[0,0,1,1,10,20];
(int) $balance = $wallet - $menu[$clientChoice]->price;
$coinCash = [];
$i = 0;
while ($balance > 0 && $i < 8) {
    if(!$coinAmount[$i]==0) {
        $reminder = $balance % $coins[$i];
        if ($reminder == 0) {
            $coinCash[$coins[$i]] = ($balance / $coins[$i]);
            $balance = $balance / $coins[$i];
            break;
        } else {
            $coinCash[$coins[$i]] = (intval($balance / $coins[$i]));
            $balance = $reminder;
            $i++;
        }
    } else {
        $i++;
    }
}
//Display correct result
echo "Change is: " .PHP_EOL;
foreach($coinCash as $key=>$value){
    if(!$value==0){
        echo "coin value: ". $key/100 ." coin amount: ". $value.PHP_EOL;
    }
}