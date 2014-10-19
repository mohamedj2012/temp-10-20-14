<?php
// Responsibility: maintains open DB connection (singleton)
class Database {
	private static $db;
	private static $dsn = 'mysql:host=localhost;dbname=urlnoshdbphase3';
	private static $options = array (
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	);

	public static function getDB() {
		if (! isset ( self::$db )) {
			try {
				$passArray = parse_ini_file("../../../myConfig.ini");
				$username = $passArray["username"];
				$password = $passArray["password"];
				self::$db = new PDO ( self::$dsn, $username, $password, self::$options );
			} catch ( PDOException $e ) {
				echo $e->getMessage ();  // not final error handling
			}
		}
		return self::$db;
	}
}
?>