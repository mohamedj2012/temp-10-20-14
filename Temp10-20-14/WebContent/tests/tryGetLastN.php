<?php
include_once("../models/CommentDB.class.php");
include_once("../models/Database.class.php");
include_once("../models/CommentData.class.php");
include_once("../models/CommentTagsDB.class.php");
include_once("../models/MemberClassesDB.class.php");
include_once("../views/showComments.php");

$comments = CommentDB::getLastNComments(3);
print_r($comments);

showComments($comments);