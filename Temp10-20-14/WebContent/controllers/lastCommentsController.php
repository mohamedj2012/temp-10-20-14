<?php
include_once("../views/showComments.php");
include_once("../models/CommentDB.class.php");
include_once("../models/CommentData.class.php");
include_once("../models/Database.class.php");

$myComments = CommentDB::getLastNComments(3);
showComments($myComments, "Last 3 comments");
?>