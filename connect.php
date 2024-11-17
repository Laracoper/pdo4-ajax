<?
// $conn = [
//     "host"=>"mysql-8.2",
//     "db"=>"pdo3_db",
//     "user"=>"root",
//     "pass"=>""
// ];
$host = 'mysql-8.2';
$db = 'pdo3_db';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
];
    
$pdo = new PDO($dsn, $user, $pass, $options);