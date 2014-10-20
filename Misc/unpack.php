<?php
//http://perldoc.perl.org/perlpacktut.html

$binarydata = "\x04\x00\xa0\x00";
$array = unpack("cchars/nint", $binarydata);
var_export($array);


$binarydata = "AA\0A";
  $array = unpack("c2chars/nint", $binarydata);
  foreach ($array as $key => $value)
 echo "\$array[$key] = $value <br>\n";