<?php
include_once("../views/showComment.php");
include_once("../models/CommentData.class.php");

echo "<h1>Tests for showComment class</h1><hr>";

echo "<hr><h2>It should output a valid comment</h2><hr>";

$validTest1 = array("evaluationUrl" => "http://npr.org",
                    "comment" => "This is my comment",
                    "memberClassName" => "reader",
                    "commentTagList" => array("colors", "layout"));
$s1 = new CommentData($validTest1);
showComment($s1);

?>