<?php
require __DIR__ . '../../../vendor/autoload.php';
use yudhaAng\Equation;

$units_data = [
    ['text'=>'kg', 'value' => 1],
    ['text'=>'hg', 'value' => 10],
    ['text'=>'dag', 'value' => 10],
    ['text'=>'g', 'value' => 10],
    ['text'=>'dg', 'value' => 10],
    ['text'=>'mg', 'value' => 10]
];
$options = [
    'units'         => $units_data,
    'unit_property' => 'text',
    'qty_property'  => 'value'
];
$equation   = new Equation($options);
$output     = $equation->convert(1245,'g','dag');
print_R($output);

// 
// print_r($result);
// echo "\n";

// $result     = $equation->renderText(1.745,'kg');
// print_r($result);
// echo "\n";

// $result     = $equation->convertText('1 kg, 7 hg, 4 dag, 5 g');
// print_r($result);
// echo "\n";

// $result     = $equation->convertText('1 kg, 7 hg, 4 dag, 5 g', 'mg');
// print_r($result);
// echo "\n";
// echo "\n";

// // Change Conversion Ladder
// $conversion_ladder  = json_decode(file_get_contents('data.json'),TRUE);
// $equation->units($conversion_ladder);

// $result     = $equation->convert(38,'batang','bungkus');
// print_r($result);
// echo "\n";

// $result     = $equation->renderText(12.745,'slop');
// print_r($result);
// echo "\n";

// $result     = $equation->convertText('1 bal, 2 slop, 7 bungkus, 7 batang');
// print_r($result);
// echo "\n";

// $result     = $equation->convertText('1 bal, 2 slop, 7 bungkus, 7 batang', 'bungkus');
// print_r($result);
// echo "\n";