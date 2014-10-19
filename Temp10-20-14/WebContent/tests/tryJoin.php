<?php
include_once("../models/Database.class.php");
include_once("../models/CommentData.class.php");
echo "<h1>Testing join to get rows with the tags</h1>";
$comments = array();
try {
	$db = Database::getDB ();
     $query = "SELECT comments.commentId, comments.evaluationUrl, comments.comment,
					         memberClasses.memberClassName
					FROM comments INNER JOIN memberClasses
					    on comments.memberClassId=memberClasses.memberClassId";
	$statement = $db->prepare($query);
	$statement->execute ();
	$commentRows = $statement->fetchAll(PDO::FETCH_ASSOC);
	$statement->closeCursor ();
} catch ( PDOException $e ) { // Not permanent error handling
	echo "<p>Error fetching comments ". $e->getMessage()."</p>";
}

foreach ( $commentRows as $commentRow ) {
	echo ("<p>");
	print_r ( $commentRow );
	echo "</p>";
}

// echo "<h1>Testing justing left join to get rows with the tags but order by comment Id</h1>";
// $comments = array();
// try {
// 	$db = Database::getDB ();
// 	$query = "SELECT comments.commentId, evaluationUrl, comment, commentTagMap.commentTagId  
// 			  FROM comments 
// 			     LEFT JOIN commentTagMap
//  	                ON comments.commentId = commentTagMap.commentId
// 			  ORDER BY comments.commentId";
// 	$statement = $db->prepare($query);
// 	$statement->execute ();
// 	$commentRows = $statement->fetchAll(PDO::FETCH_ASSOC);
// 	$statement->closeCursor ();
// } catch ( PDOException $e ) { // Not permanent error handling
// 	echo "<p>Error fetching comments ". $e->getMessage()."</p>";
// }

// foreach ( $commentRows as $commentRow ) {
// 	echo ("<p>");
// 	print_r ( $commentRow );
// 	echo "</p>";
// }

// echo "<h1>Testing using left join and inner join to get tag names instead of ids </h1>";
// $comments = array();
// try {
// 	$db = Database::getDB ();
// 	$query = "SELECT comments.commentId, evaluationUrl, comment, commentTags.commentTagName
// 				  FROM comments 
// 			         LEFT JOIN commentTagMap
// 	 	                  ON comments.commentId = commentTagMap.commentId
// 			         INNER JOIN commentTags
// 			              ON commentTagMap.commentTagId = commentTags.commentTagId
// 			ORDER BY comments.commentId";
// 	$statement = $db->prepare($query);
// 	$statement->execute ();
// 	$commentRows = $statement->fetchAll(PDO::FETCH_ASSOC);
// 	$statement->closeCursor ();
// } catch ( PDOException $e ) { // Not permanent error handling
// 	echo "<p>Error fetching comments ". $e->getMessage()."</p>";
// }

// foreach ( $commentRows as $commentRow ) {
// 	echo ("<p>");
// 	print_r ( $commentRow );
// 	echo "</p>";
// }

// echo "<h1>Testing using group concatentation </h1>";
// $comments = array();
// try {
// 	$db = Database::getDB ();
// 	$query = "SELECT comments.commentId, evaluationUrl, comment, 
// 			         GROUP_CONCAT(commentTags.commentTagName SEPARATOR ';') as taglist
// 				  FROM comments 
// 			         LEFT JOIN commentTagMap
// 	 	                  ON comments.commentId = commentTagMap.commentId
// 			         LEFT JOIN commentTags
// 			              ON commentTagMap.commentTagId = commentTags.commentTagId
// 			      GROUP BY comments.commentId";


// $statement = $db->prepare($query);
// $statement->execute ();
// $commentRows = $statement->fetchAll(PDO::FETCH_ASSOC);
// $statement->closeCursor ();
// } catch ( PDOException $e ) { // Not permanent error handling
// 	echo "<p>Error fetching comments ". $e->getMessage()."</p>";
// }
// foreach ( $commentRows as $commentRow ) {
// 	echo ("<p>");
// 	print_r ( $commentRow );
// 	echo "</p>";
// }

// function getCommentArray($rowSet) {
// 	$comments = array ();
// 	foreach ( $rowSet as $commentRow ) {
// 		$tags = $commentRow['taglist'];
// 		echo "tags are: $tags<br>";
// 		$commentTags = explode(";", $tags);
// 		print_r($commentTags);
// 		$comment = new CommentData ( $commentRow );
// 		array_push ( $comments, $comment );
// 	}
// 	return $comments;
// }

// echo "<h2>Now calling comment data</h2>";
// $myArray = getCommentArray($commentRows);
// print_r($myArray);
// foreach ( $rowSet as $commentRow ) {
// 	$tags = $commentRow['taglist'];
// 	echo "tags are: $tags<br>";
// 	$comment = new CommentData ( $commentRow );
// 	array_push ( $comments, $comment );
// }
?> 