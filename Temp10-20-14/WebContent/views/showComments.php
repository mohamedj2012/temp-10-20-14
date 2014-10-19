<?php
// Displays a list of all comments 
// Input: an array of CommentData objects
function showComments($commentList, $msg) {
	echo "<h1>".$msg."</h1>";
	
	foreach ($commentList as $comment) {
		$comment->printComment();
	}
	
	echo '<h3><a href="../index.php">Back to home</a>';
}
?>