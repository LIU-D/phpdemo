<?php
//
class foo
{
	public function printltem($string)
	{
		echo 'Foo:' . $string . PHP_EOL;
	}
	public function printPHP()
	{
		echo 'PHP is great.' . PHP_EOL;
	}
}


class bar extends foo{
    public function printltem($string){
        echo 'Bar:' . $string . PHP_EOL;
    }
}

$foo = new foo();
$bar = new bar();



$foo->printltem('baz');
$foo->printPHP();
$bar->printltem('baz');
$bar->printPHP();

?>