<?php
include_once("../models/CommentTagsDB.class.php");
include_once("../models/Database.class.php");

echo "<h1>Tests for commentTagesDB class";

echo "<hr><h2>It should convert a rowset to key-value array</h2>";
$rowset = array(array("commentTagId" => 1, "commentTagName" => "reader"),
		        array("commentTagId" => 2, "commentTagName" => "nosher"));
echo "<h3>Indexing by name</h3>";
$myArray = CommentTagsDB::getArray($rowset, "commentTagName", "commentTagId");
print_r($myArray);

echo "<h3>Indexing by id</h3>";
$myArray = CommentTagsDB::getArray($rowset, 'commentTagId', 'commentTagName');
print_r($myArray);


echo "<hr><h2>It should fetch the entire table as a id-name associative array</h2>";
$myArray= CommentTagsDB::getMap('commentTagId', 'commentTagName');
print_r($myArray);

echo "<hr><h2>It should fetch a name by id</h2>";
$myName = CommentTagsDB::getNameById(1);
echo "Name for Id 1 is $myName";


echo "<hr><h2>It should fetch an id by  name</h2>";
$myName = "layout";
$myId = CommentTagsDB::getIdByName($myName);
echo "Id for name $myName is $myId";

?>
