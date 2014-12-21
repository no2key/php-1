<?php
require_once __DIR__."/vendor/autoload.php";

$a = [
    'ak1' => 'av1',
    'ak2' => 'av2',
    'ak3' => 'av3',
    'ak4' => 'av4',
    'ak5' => 'av5',
];
 
$b = [
    'bk1' => 'bv1',
    'bk2' => 'bv2',
    'bk3' => 'bv3',
    'bk4' => 'bv4',
    'bk5' => 'bv5',
];
 

$object = new \stdClass();
$object->prop1 = 10;
$object->prop2 = 20;
$object->prop3 = 30;
$object->prop4 = 40;
 
$c = [
    'a' => &$a,
    'b' => $b,
    $object
];
 
// dump($c);

class Test1 {
    public $prop1 = 10;
    private $prop2 = 20;
    protected $prop3 = 30;
    private $prop4 = 40;
 
    public function __construct($value) {
        $this->undefinedProp = $value;
    }
}
 
$t1 = new Test1(50);
 
// dump($t1);

class Test {
    public $m1;
    protected $m2;
 
    public function __construct() {
        $this->m2 = function() {
            return "I'm method 2";
        };
    }
 
    public function buildFunction() {
        $this->m3 = function() {
            return "I'm method 3";
        };
    }
 
    public function __call($method, $args)
    {
        if (isset($this->$method)) {
            $func = $this->$method;
            return call_user_func_array($func, $args);
        }
    }
 
}
 
$t = new Test();
$m1 = function() {
    return "I'm method 1";
};
$t->m1 = $m1;
$t->buildFunction();
$t->m1();
 
dump($t);
