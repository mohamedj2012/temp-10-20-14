<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/CommentData.class.php");

class CommentDataTest extends UnitTestCase {
	function test_validInput() {
		$this->assertEqual(2, 2, "x+y should be 3");
		$validTest = array("evaluationUrl" => "http://npr.org",
                      "comment" => "Interesting site",
                      "memberClassName" => "reader",
                      "commentTagList" => array("colors", "layout"));
		$s1 = new CommentData($validTest);
  		$this->assertNotNull($s1, "CommentData object $s1");
  		$this->assertTrue(is_a($s1, 'CommentData'), "Should be a CommentData object");
		$this->assertEqual($s1->getEvaluationUrl(), "http://npr.org",
		       "evaluation url should be http://npr.org but is " .$s1->getEvaluationUrl());
		$this->assertEqual($s1->getComment(), "Interesting site",
		       "comment should be Interesting site but is " .$s1->getComment());
		$this->assertEqual($s1->getMemberClassName(), "reader",
		       "member class name should be reader but is ".$s1->getMemberClassName());
		$tags = $s1->getCommentTagList();
		$this->assertTrue(is_array($tags), 
				 "the tag list should be an array but is not");
		$params = $s1->getParameters();
		$this->assertEqual($params['evaluationUrl'], "http://npr.org",
		         "Returned evaluationUrl should be http://npr.org but is ".$params['evaluationUrl']);
		$this->assertEqual($params['comment'], "Interesting site",
				"Returned comment should be Interesting site but is ".$params['comment']);
		$this->assertEqual($params['memberClassName'], "reader",
		        "Returned member class name should be reader but is ".$params['memberClassName']);
	}
}
// // echo "<h1>Tests for CommentData class</h1>";


// echo "<h2>It should create a valid object when all input is provided</h2>";
// $validTest = array("evaluationUrl" => "http://npr.org",
//                    "comment" => "Interesting site",
//                    "memberClassName" => "reader",
//                    "commentTagList" => array("colors", "layout"));
// $s1 = new CommentData($validTest);
// $s1->printComment();


// // echo "<h2>It should extract the parameters that went in</h2>";
// $props = $s1->getParameters();
// print_r($props);
// echo "<br>";
?>