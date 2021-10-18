<?php 
// Database Handler
// Interfaces with MySQL 8

$options = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];

$dsn = constant("DB_HOST");
$dbu = constant("DB_USER");
$dbp = constant("DB_PASS");

$pdo = new PDO($dsn, $dbu, $dbp, $options);

if ($sql_text == '')
{
    throw new Exception('SQL Text was not supplied to PDO in var $sql_text');
}

$sql = $pdo->query($sql_text);
// grab all rows and return as $result
$result = $sql->fetchAll();

?>