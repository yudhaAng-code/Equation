<?php
require __DIR__ . '../../../vendor/autoload.php';
use yudhaAng\Equation;

$equation = new Equation;

$result     = $equation->convert(1.745,'kg','g');
print_r($result);
echo "\n";

$result     = $equation->renderText(1.745,'kg');
print_r($result);
echo "\n";

$result     = $equation->convertText('1 kg, 7 hg, 4 dag, 5 g');
print_r($result);
echo "\n";

$result     = $equation->convertText('1 kg, 7 hg, 4 dag, 5 g', 'mg');
print_r($result);
echo "\n";
echo "\n";

// Change Conversion Ladder
$conversion_ladder  = json_decode(file_get_contents('data.json'),TRUE);
$equation->units($conversion_ladder);

$result     = $equation->convert(38,'batang','bungkus');
print_r($result);
echo "\n";

$result     = $equation->renderText(12.745,'slop');
print_r($result);
echo "\n";

$result     = $equation->convertText('1 bal, 2 slop, 7 bungkus, 7 batang');
print_r($result);
echo "\n";

$result     = $equation->convertText('1 bal, 2 slop, 7 bungkus, 7 batang', 'bungkus');
print_r($result);
echo "\n";