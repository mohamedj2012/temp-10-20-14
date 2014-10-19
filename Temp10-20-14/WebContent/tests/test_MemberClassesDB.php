<?php
include_once("../models/MemberClassesDB.class.php");
include_once("../models/Database.class.php");

echo "<h1>Tests for MemberClassesDB class";

echo "<hr><h2>It should convert a rowset to key-value array</h2>";
$rowset = array(array("memberClassId" => 1, "memberClassName" => "reader"),
		        array("memberClassId" => 2, "memberClassName" => "nosher"));
echo "<h3>Indexing by name</h3>";
$myArray = MemberClassesDB::getArray($rowset, "memberClassName", "memberClassId");
print_r($myArray);

echo "<h3>Indexing by id</h3>";
$myArray = MemberClassesDB::getArray($rowset, 'memberClassId', 'memberClassName');
print_r($myArray);


echo "<hr><h2>It should fetch the entire table as a id-name associative array</h2>";
$myArray= MemberClassesDB::getMap('memberClassId', 'memberClassName');
print_r($myArray);

echo "<hr><h2>It should fetch a name by id</h2>";
$myName = MemberClassesDB::getNameById(1);
echo "Name for Id 1 is $myName";


echo "<hr><h2>It should fetch an id by  name</h2>";
$myName = "moderator";
$myId = MemberClassesDB::getIdByName($myName);
echo "Id for name $myName is $myId";

?>
