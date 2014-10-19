<?php
echo "<h1>Tests for postCommentController </h1><hr>";

echo "<hr><h2>It should add a comment to the database when a valid form is filled out</h2><hr>";

$_POST = array("evaluationUrl" => "http://npr.org",
		        "comment" => "This is my comment",
                "memberClassName" => "nosher",
                "commentTagList" => array("layout", "semantics", "content"));
include("../controllers/postcommentController.php")

?>