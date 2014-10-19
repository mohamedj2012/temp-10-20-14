<?php
// Displays a list of all comments 
// Input: an array of CommentData objects
function showComment($comment) {
    $comment->printComment();
	echo '<h3><a href="../index.php">Back to home</a>';
}
?>