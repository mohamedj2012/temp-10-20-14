<?php
require_once('autorun.php');
//require_once('../classes/log.php');

class Test1 extends UnitTestCase {
	function test_pass1() {
		$boolean = false;
		$this->assertFalse ( $boolean, "[$boolean should be false]" );
	}
	
	function test_pass2() {
		$x = 1;
		$y = 2;
		$total = $x + $y;
		$this->assertEqual ( 3, $total, "[x + y should be 3 instead of $total]" );
	}
}

?>