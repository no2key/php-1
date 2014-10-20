<?php
//http://perldoc.perl.org/perlpacktut.html

$binarydata = pack("nvc*", 0x1234, 0x5678, 65, 66);
echo $binarydata;