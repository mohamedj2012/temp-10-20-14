<?php
// Responsibility: Handles all queries pertaining to comment
class CommentDB {
   

	
	public static function addComment($myComment) {
		// Inserts the comment contained in a CommentData object into DB
		$query = "INSERT INTO comments (evaluationUrl, comment, memberClassId)
		            VALUES(:evaluationUrl, :comment, :memberClassId)";
		$returnId = 0;
		try {
			$db = Database::getDB ();
			$evaluationUrl = $myComment->getEvaluationUrl();
			$comment = $myComment->getComment();
			$memberClassName = $myComment->getMemberClassName();
			$memberClassId = MemberClassesDB::getIdByName ($memberClassName);
			$statement = $db->prepare ($query);
			$statement->bindValue(":evaluationUrl", $evaluationUrl);
			$statement->bindValue(":comment", $comment);
			$statement->bindValue(":memberClassId", $memberClassId);
			$statement->execute ();
			$statement->closeCursor();
			$returnId = $db->lastInsertId("commentId");
			$myTags = $myComment->getCommentTagList();
			CommentDB::writeCommentTags($db, $returnId, $myTags);
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error adding comment ".$e->getMessage()."</p>";
		}
		return $returnId;
	}
	
	public static function getAll() {
		$query =  "SELECT comments.commentId, evaluationUrl, comment,
				             memberClasses.memberClassName, commentDateCreated,
			                 GROUP_CONCAT(commentTags.commentTagName SEPARATOR ';') as taglist
				      FROM comments
			                 LEFT JOIN commentTagMap
	 	                        ON comments.commentId = commentTagMap.commentId
			                 LEFT JOIN commentTags
			                    ON commentTagMap.commentTagId = commentTags.commentTagId
					         LEFT JOIN memberClasses
					            ON comments.memberClassId = memberClasses.memberClassId
			          GROUP BY comments.commentId";
		$comments = array();
		try {
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->execute ();
			$comments = CommentDB::getCommentArray($statement->fetchAll(PDO::FETCH_ASSOC));
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting all comments ".$e->getMessage()."</p>";
		}
		return $comments;
	}
	
	public static function getLastNComments($n) {
		$query =  "SELECT comments.commentId, evaluationUrl, comment,
				             memberClasses.memberClassName, commentDateCreated,
			                 GROUP_CONCAT(commentTags.commentTagName SEPARATOR ';') as taglist
				      FROM comments
			                 LEFT JOIN commentTagMap
	 	                        ON comments.commentId = commentTagMap.commentId
			                 LEFT JOIN commentTags
			                    ON commentTagMap.commentTagId = commentTags.commentTagId
					         LEFT JOIN memberClasses
					            ON comments.memberClassId = memberClasses.memberClassId
					  GROUP BY comments.commentId 
		              ORDER BY comments.commentDateCreated DESC LIMIT " .strval($n);
				      
		$comments = array();
		try {
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->execute ();
			$comments = CommentDB::getCommentArray($statement->fetchAll(PDO::FETCH_ASSOC));
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting last n comments ".$e->getMessage()."</p>";
		}
		return $comments;
	}
	
	public static function getCommentById($commentId) {
		// Returns a comment object or null (illustration of two separate selects)
		// I could have used the same code as in fetchAll, but I want to talk about transactions
		$query = "SELECT comments.commentId, evaluationUrl, comment, 
				         memberClasses.memberClassName, commentDateCreated
		             FROM comments
		                 LEFT JOIN memberClasses
		                    ON comments.memberClassId = memberClasses.memberClassId
				     WHERE comments.commentId = :commentId";
		$comment = null;
		try {
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->bindParam(":commentId", $commentId); // Only binds at execute time
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			if (!empty($result)) {
			   $result['commentTagList'] = CommentDB::getTagsByCommentId($commentId);
			   $comment = new CommentData($result);
			}
			$statement->closeCursor();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error retrieving comments by commentId ".$e->getMessage()."</p>";
		}
		return $comment;
	}
	
	public static function getCommentArray($rowSets) {
		$comments = array ();
		foreach ( $rowSets as $commentRow ) {
			$comment = CommentDB::getComment($commentRow);
			array_push ( $comments, $comment );
		}
		return $comments;
	}
	
	public static function getComment($commentRow) {
	   // Return a comment object from a rowset.
			if (isset($commentRow['taglist'])) {
				$tags = $commentRow['taglist'];
				$commentTags = explode(";", $tags);
				$commentRow['commentTagList'] = explode(";", $tags);
			}
			return new CommentData ( $commentRow );
	}
	
	public static function writeCommentTags($db, $id, $tags) {
		// Write the array of $tags for comment $id to commentTagMap
		if (empty($tags))
			return;
		$query = "INSERT INTO commentTagMap (commentTagId, commentId)
		                           VALUES(:commentTagId, :commentId)";
		$tagMap = CommentTagsDB::getMap('commentTagName', 'commentTagId');
		try {
			$statement = $db->prepare ($query);
			$statement->bindParam(":commentId", $id);
			
			for ($k = 0; $k < count($tags); $k++) {
			   $statement->bindParam(":commentTagId", $tagMap[$tags[$k]]);
			   $statement->execute ();
			}
			$statement->closeCursor();
		} catch ( PDOException $e ) { // Not permanent error handling
				echo "<p>Error adding comment tags for comment ".$e->getMessage()."</p>";
		}
	}
	
	public static function getTagsByCommentId($commentId) {
		$query = "SELECT commentTags.commentTagName 
				     FROM commentTagMap 
						LEFT JOIN commentTags
			               ON commentTagMap.commentTagId = commentTags.commentTagId
				     WHERE commentTagMap.commentId = :commentId";
		
		$tags = array ();
		try {
			$db = Database::getDB ();
			$statement = $db->prepare ( $query );
			$statement->bindParam ( ":commentId", $commentId );
			$statement->execute ();
			$results = $statement->fetchAll ( PDO::FETCH_ASSOC );
			$tags = array();
			for ($k = 0; $k < count($results); $k++) {
				array_push($tags, $results[$k]['commentTagName']);
			}
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error retrieving comments tags for comment .$commentId " . $e->getMessage () . "</p>";
		}
		return $tags;
	}
	
}
?>
