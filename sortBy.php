<?php
$a = array(
       0=>array("id"=>1,"name"=>"小何","addr"=>"0:1"),
       1=>array("id"=>2,"name"=>"小刚","addr"=>"0:1:2"),
       2=>array("id"=>3,"name"=>"小军","addr"=>"0:1:3"),
       3=>array("id"=>4,"name"=>"公司","addr"=>"0:4"),
    );
function sort_by($array, $keyname = null, $sortby){
    $myarray = $inarray = array();
    foreach($array as $i=>$befree){
      $myarray[$i] = $array[$i][$keyname];
    }
    switch($sortby){
       case 'asc':
       asort($myarray);
       break;
       case 'arsort':
       arsort($myarray);
       break;
       case 'natcasesor':
       natcasesor($myarray);
       break;
    }
    foreach($myarray as $key=>$befree){
        $inarray[$key] = $array[$key];
        }
          return $inarray;
}
print_r(sort_by($a,"addr","arsort"));

print_r($a[2]["id"]);
