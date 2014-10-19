<?php
require_once('autorun.php');
class Test3 extends UnitTestCase {
	function test_fail(){
		$x = 1;
		$y = 2;
		$total = $x + $y;
		$this->assertEqual(3, $total, "x+y should be 3");
	}
}
?>