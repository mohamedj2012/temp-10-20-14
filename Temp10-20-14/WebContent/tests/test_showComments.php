<?php
include_once("../views/showComments.php");
include_once("../models/CommentData.class.php");

echo "<h1>Tests for showComments class</h1><hr>";

echo "<hr><h2>It should output when a valid list is provided</h2><hr>";

$validTest1 = array("evaluationUrl" => "http://npr.org",
		            "comment" => "This is my comment",
                    "memberClassName" => "reader",
                   "commentTagList" => array("colors", "layout"));
$s1 = new CommentData($validTest1);
$validTest2 = array("evaluationUrl" => "http://google.com",
		            "comment" => "Searching now",
                    "memberClassName" => "nosher",
                    "commentTagList" => array("semantics", "layout"));
$s2 = new CommentData($validTest2);
$commentList = array($s1, $s2);

showComments($commentList);

?>