<?php

include_once("../models/CommentDB.class.php");
include_once("../models/Database.class.php");
include_once("../models/CommentData.class.php");
include_once("../models/CommentTagsDB.class.php");
include_once("../models/MemberClassesDB.class.php");




echo "<h1>Tests for CommentDB class";
$testComment = array("evaluationUrl" => "http://yahoo1.com",
		             "comment" => "Not here", 
		             "memberClassName" => "nosher",
                     "taglist" => "layout;semantics");

$testComments = array($testComment, $testComment);

echo "<h2>It should convert a rowset to a CommentData object</h2>";
$testResults1 = CommentDB::getComment($testComment);
$testResults1->printComment();


echo "<h2>It should convert an array of associative arrays to an array of CommentData</h2>";
$testResults = CommentDB::getCommentArray($testComments);

echo "<hr>";
print_r($testResults);

echo "<hr><h2>It should fetch the entire comment table</h2>";

$myComments = CommentDB::getAll();
foreach ($myComments as $comment)
   $comment->printComment();
echo "<hr>";


echo "<hr><h2>It should get comments by Id</h2>";
for ($k = 1; $k <= 10; $k++) {
    $comment = commentDB::getCommentById($k);
    if (!is_null($comment)) {
       echo "$k:<br>";
       $comment->printComment();
       echo "<br>";
    }
}

echo "<h2>It should insert a new comment</h2>";
$test2 = array("evaluationUrl" => "http://npr.org",
		"comment" => "Interesting site",
		"memberClassName" => "nosher", "commentTagList" => array('layout', 'semantics'));

$t1= new CommentData($test2);
$t1->printComment();
$returnValue = commentDB::addComment($t1);
echo "Adding a comment with ID ". strval($returnValue) . "<br>";

echo "<h2>Adding a comment and inserting tags later</h2>";
$test3 = array("evaluationUrl" => "http://community.org",
		"comment" => "Community site",
		"memberClassName" => "moderator");
$t3 = new CommentData($test3);
$returnId = commentDB::addComment($t3);
$myTags = array('layout', 'semantics', 'content');
commentDB::writeCommentTags(Database::getDB(), $returnId, $myTags);
echo "<h3>Retrieve the object after written</h3>";
$retrieved = commentDB::getCommentById($returnId);
$retrieved->printComment();
?>
