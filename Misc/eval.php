<?php

$string = "beautiful";
$time = "winter";

$str = 'This is a $string $time morning!';
// echo $str. "\r\n";

eval("\$str = \"$str\";");
echo $str;
