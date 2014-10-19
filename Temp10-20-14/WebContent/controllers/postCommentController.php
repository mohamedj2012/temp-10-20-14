<?php
include_once("../models/CommentData.class.php");
include_once("../models/CommentDB.class.php");
include_once("../models/Database.class.php");
include_once("../views/showComment.php");
include_once("../models/MemberClassesDB.class.php");
include_once("../models/CommentTagsDB.class.php");

$s1 = new CommentData($_POST);
$id = CommentDB::addComment($s1);
$comment = CommentDB::getCommentById($id);
showComment($comment);
?>