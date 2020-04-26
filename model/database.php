<?php
$dsn = 'mysql:host=	ffn96u87j5ogvehy.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=gl1sj55xh3ym3896';
$username = 'nghqg6dkmjn3wrwu';
$password = 'waaw7b4o5bwpb0g6';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('./errors/database_error.php');
    exit();
}
?>