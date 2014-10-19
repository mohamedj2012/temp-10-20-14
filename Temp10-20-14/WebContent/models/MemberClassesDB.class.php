<?php
// Responsibility: Implements an enumerated type for memberClasses
class MemberClassesDB {

	public static function getMap($keyName, $valueName) {
		// Returns an associative array key versus value
		$query = "SELECT * 
				     FROM memberClasses";
		$memberClasses = array ();
		try {
			$db = Database::getDB ();
			$statement = $db->prepare ($query);
			$statement->execute();
			$rowsets = $statement->fetchAll( PDO::FETCH_ASSOC );
			$memberClasses = MemberClassesDB::getArray($rowsets, $keyName, $valueName);
			$statement->closeCursor ();
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "Error getting map of $keyName to $valueName ". $e->getMessage()."</p>";
		}
		return $memberClasses;
	}

	public static function getNameById ($Id) {
		// Returns the name given id or null if no item exists
		$Id = strval($Id);
		$query = "SELECT memberClassName 
				     FROM memberClasses
			         WHERE memberClassId = :id";
		$name = null;
		try {
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->bindParam(":id", $Id); // Only binds at execute time
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			$name = $results[0]['memberClassName'];
			$statement->closeCursor();

		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting name from $id ".$e->getMessage()."</p>";
		}
		return $name;
	}

	public static function getIdByName ($name) {
		// Returns the id given name or null if no item exists
		$query = "SELECT memberClassId FROM memberClasses 
				     WHERE memberClassName = :name";
		$id = null;
		try {
			$db = Database::getDB ();
			$query = 'SELECT memberClassId 
					     FROM MemberClasses 
					     WHERE memberClassName = :name';
			$statement = $db->prepare($query);
			$statement->bindParam(":name", $name); // Only binds at execute time
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			$id = $results[0]['memberClassId'];
			$statement->closeCursor();

		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting ID from $name ".$e->getMessage()."</p>";
		}
		return $id;
	}

	public static function getArray($rowset, $keyName, $valueName) {
		// Returns an associative array from $rowset based on item names
		print_r($rowset);
		$index = array();
		for ($k = 0; $k < count($rowset); $k++) {
			$item = $rowset[$k];
			$key = strval($item[$keyName]);
			$value = $item[$valueName];
			$index[$key] = strtolower($value);
		}
		return $index;
	}
}
?>