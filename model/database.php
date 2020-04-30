<?php
$dsn = 'mysql:host=ffn96u87j5ogvehy.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=gl1sj55xh3ym3896';
$username = 'nghqg6dkmjn3wrwu';
$password = 'waaw7b4o5bwpb0g6';

try {
    $options =[
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('./errors/database_error.php');
    exit();
}
?>