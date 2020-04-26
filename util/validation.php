<?php
function username_already_exists($username)
{
    global $db;
    $query = 'SELECT id from administrators where username=:username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    return ( $row ? 1 : 0 );
}

?>