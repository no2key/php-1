<?php

namespace Foobar;

class Foo {
    public function test() {
        print "Hello world!\n";
        $this->privateF();
    }

    private function privateF()
    {
    	echo "privateF";
    }
}

$test = new Foo();

call_user_func(array($test, 'test')); // As of PHP 5.3.0


