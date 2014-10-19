<?php
// Temporary code for trying out select *
$dsn = 'mysql:host=localhost;dbname=urlnoshdb1';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO($dsn, $username, $password, $options);
echo "<h1>Testing PDO before putting into code</h1>";

echo "<h3>Executing select all query</h3>";
$query = 'SELECT * FROM comments INNER JOIN memberclass 
					  on comments.classId=memberclass.classId';
$statement = $db->prepare($query);
$statement->execute();

$commentRows = $statement->fetchAll();
foreach ( $commentRows as $commentRow ) {
	echo ("<p>");
	print_r ( $commentRow );  
	echo "</p>";  
}

?> 