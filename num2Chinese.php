<?php

private function number2Chinese($num, $m = 1)
{
$numbers = array(0 => "零","一","二","三","四","五","六","七","八","九");
// array(0=>"零","壹","贰","叁","肆","伍","陆","柒","捌","玖");
$unit1 = array(0 => "","十","百","千");
// var $unit1 = array(1=>"拾","佰","仟");
$unit2 = array(0 => "","万","亿");

if(!is_numeric($num)){
exit("Number Error!");
}

$num = trim(strval($num));
$zs = null;
$xs = null;
$chn = null;
$len = strlen($num);
$i = strpos($num,".");

if(is_numeric($i)){
$zs = $i == 0?"0":substr($num,0,$i);
if($i == 0){
$zs = "0";
$xs = substr($num,1);
}else if($i == $len - 1){
$zs = substr($num,0,$i);
;
}else{
$zs = substr($num,0,$i);
$xs = substr($num,$i + 1);
}
} else{
$zs = $num;
}

if($zs){
$i = 0;
$len = strlen($zs);
while($i < $len && $zs[$i] == "0"){
$i++;
}
if($i){
$zs = substr($zs,$i);
}
}

if($xs){
$i = strlen($xs) - 1;
while($i && $xs[$i] == "0"){
$i--;
}
if($i > -1){
$xs = substr($xs,0,$i + 1);
}
}

if($zs){
$len = strlen($zs);
$i = $len;
$parts = array();
while($i > 4){
$i -= 4;
$parts[] = substr($zs,$i,4);
}
$parts[] = substr($zs,0,$i);
$chn = '';
$l = 0;
foreach($parts as $part){
if($part == "0000"){ continue; }
$t = '';
for($i = 0,$j = strlen($part);$i < $j;$i++){
$p = 0;
while($i + $p < $j && $part[$i + $p] == "0"){
$p++;
}
if($i + $p == $j){ continue; }
if($p){ $i += $p - 1; }
$t .= $numbers[$part[$i]];
if($part[$i]){
$t .= $unit1[$j - $i - 1];
}
}

if(!isset($unit2[$l])){
if($l % 2){
$unit2[$l] = $unit2[$l - 1] . $unit2[1];
} else {
$unit2[$l] = $unit2[$l - 1] . $unit2[2];
}
}
$t .= $unit2[$l];
$chn = $t . $chn;
$l++;
}
} else {
$chn = "零";
}

if($xs){
$chn .= "点";
for($i = 0,$j = strlen($xs);$i < $j;$i++){
$chn .= $numbers[$xs[$i]];
}
}

return $chn;
}
