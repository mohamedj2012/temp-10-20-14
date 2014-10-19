<?php
require_once('c:/Programs/simpletest/autorun.php');

class ModelTests extends TestSuite {
	function __construct() {
		parent::__construct();
		$this->addFile ( __DIR__."/CommentData_test.php" );
		$this->addFile ( __DIR__."/Test3_test.php" );
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