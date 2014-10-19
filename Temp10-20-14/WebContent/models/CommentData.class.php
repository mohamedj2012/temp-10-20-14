<?php
// Responsibility: Holds data for comment and performs validation
// Constructor expects an associative array with field values for initialization
class CommentData {
	private $commentId;
	private $evaluationUrl;
	private $comment;
	private $memberClassName;
	private $commentTagList;
	private $commentDateCreated;
	
	public function __construct($formInput) {
		$this->initialize($formInput);
	}
	
	public function getComment() {
		return $this->comment;
	}
	
	public function getCommentDateCreated() {
		return $this->commentDateCreated;
	}
	
	public function getCommentId() {
		return $this->commentId;
	}
	
	public function getCommentTagList() {
		return $this->commentTagList;
	}
	
	public function setCommentTagList($list) {
		$this->commentTagList = $list;
	}
	
	public function getEvaluationUrl() {
		return $this->evaluationUrl;
	}
	
	public function getMemberClassName() {
		return $this->memberClassName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("commentId" => $this->commentId,
		                    "evaluationUrl" => $this->evaluationUrl,
		                    "comment" => $this->comment,
				            "memberClassName" => $this->memberClassName,
				            "commentTagList" => $this->commentTagList,
				            "commentDataCreated" => $this->commentDateCreated
		                   );
		return $paramArray;
	}
	
	public function printComment() {
		echo "<h1>URL Nosh Member Comment</h1>";
		echo "Comment Id: $this->commentId<br>";
		echo "Evaluation url: $this->evaluationUrl<br>";
		echo "Comment: $this->comment<br>";
		echo "Member class: $this->memberClassName<br>";
		echo "Comment tags: [ ";
		for ($k = 0; $k < count($this->commentTagList); $k++)
	         echo $this->commentTagList[$k]." ";
		echo "]<br>";
		echo "Date created: $this->commentDateCreated<br>";
	}
	
	public function __toString() {
		$str = "Id:[".$this->commentId."] url:[".$this->evaluationUrl."] ".
		"class:[".$this->memberClassName."] comment:[".$this->comment."] tags:[ ";
		for ($k = 0; $k < count($this->commentTagList); $k++)
	         $str = $str.$this->commentTagList[$k]." ";
		$str = $str ."]";
		return $str;
	}

	
	private function initialize($formInput) {
		if (isset($formInput['commentId']))
			$this->commentId = $formInput['commentId'];
		else 
			$this->commentId = 0;
		if (isset($formInput['evaluationUrl']))
			$this -> evaluationUrl = $formInput['evaluationUrl'];
		if (isset($formInput['comment']))
			$this->comment = $formInput['comment'];
		if (isset($formInput['memberClassName']))
			$this->memberClassName = $formInput['memberClassName'];	
		if (isset($formInput['commentTagList']))
			$this->commentTagList = $formInput['commentTagList'];
		if (isset($formInput['commentDateCreated']))
			$this->commentDateCreated = $formInput['commentDateCreated'];
	}
}
?>