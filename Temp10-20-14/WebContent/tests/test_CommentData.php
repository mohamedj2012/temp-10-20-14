<?php
include_once("../models/CommentData.class.php");
echo "<h1>Tests for CommentData class</h1>";


echo "<h2>It should create a valid object when all input is provided</h2>";
$validTest = array("evaluationUrl" => "http://npr.org",
                   "comment" => "Interesting site",
                   "memberClassName" => "reader",
                   "commentTagList" => array("colors", "layout"));
$s1 = new CommentData($validTest);
$s1->printComment();


echo "<h2>It should extract the parameters that went in</h2>";
$props = $s1->getParameters();
print_r($props);
echo "<br>";
echo $s1;
?>