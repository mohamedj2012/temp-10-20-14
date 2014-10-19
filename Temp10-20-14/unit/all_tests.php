<?php
require_once('c:/Programs/simpletest/autorun.php');

class AllTests extends TestSuite {
	function __construct() {
		parent::__construct();
		$thisDir = __DIR__;
		$this->addFile ( __DIR__."/Test1_test.php" );
		$this->addFile ( __DIR__."/Test2_test.php" );
		$this->addFile ( __DIR__."/models/model_tests.php" );
// 		$this->add ( new Test1 () );
// 		$this->add ( new Test2 () );
	}

// 	function AllTests() {
// 		parent::__construct();
// 		$this->addFile('Test1_test.php');
// 		$this->addFile('Test2_test.php');
// 		//$this->addFile('CommentData_test.php');
// 	}
}
?>