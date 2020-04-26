<?php
function add_admin($username, $password)
{
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $pdo_values = array("username"=>$username,
                        "password"=>$hash
    );
    $sql ="insert into administrators (username, password) values(:username, :password);";
    $statement = $db->prepare($sql);
    $statement->execute($pdo_values);
    $statement->closeCursor();
    return $statement->errorCode();
}

function is_valid_admin_login($username, $password)
{
    global $db;
    $query = 'SELECT password FROM administrators WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    if ( empty($hash) ) return 0;
    else return password_verify($password, $hash);
}
?>