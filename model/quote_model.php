<?php

function retrieve_default_quote_list($public=0) {
    global $db;
    $sql ="select quote.*,author.author,category.category from quote ";
    $sql.="left join author on author.id=quote.author_id ";
    $sql.="left join category on category.id=quote.category_id ";
    if ( $public ) $sql.="where quote.approved = 1 ";
    $sql.="order by quote.id";
    $statement = $db->prepare($sql);
    $statement->execute();
    $quotes = $statement->fetchAll();
    $statement->closeCursor();
    return $quotes;
}

function retrieve_api_default_quote_list($public=0) {
    global $db;
    $sql ="select quote.id,quote.text,author.author,category.category from quote ";
    $sql.="left join author on author.id=quote.author_id ";
    $sql.="left join category on category.id=quote.category_id ";
    if ( $public ) $sql.="where quote.approved = 1 ";
    $sql.="order by quote.id";
    $statement = $db->prepare($sql);
    $statement->execute();
    $quotes = $statement->fetchAll();
    $statement->closeCursor();
    return $quotes;
}

function retrieve_sorted_quote_list($author=0,$category=0,$order=0, $approved=0, $limit=0) {
    global $db;
    $pdo_values = array();
    $sql ="select quote.*,author.author,category.category from quote ";
    $sql.="left join author on author.id=quote.author_id ";
    $sql.="left join category on category.id=quote.category_id ";
    $position = "where ";
    if ( isset($author) and $author ) {
        $sql.= $position . "author.id=:author ";
        $pdo_values["author"]=$author;
        $position = "and ";
    }
    if ( isset($category) and $category ) {
        $sql.= $position . "category.id=:category ";
        $pdo_values["category"]=$category;
        $position = "and ";
    }
    if ( $approved) $sql.= "and quote.approved=1 ";
    if ( isset($order) and $order ) $sql.= "order by quote.id";
    else $sql.= "order by quote.id";
    if ( $limit ) " limit 0,".$limit;
    $statement = $db->prepare($sql);
    $statement->execute($pdo_values);
    $quotes = $statement->fetchAll();
    $statement->closeCursor();
    return $quotes;
}

function retrieve_api_sorted_quote_list($author=0,$category=0,$order=0, $approved=0, $limit=0) {
    global $db;
    $pdo_values = array();
    $sql ="select quote.id,quote.text,author,author,category.category from quote ";
    $sql.="left join author on author.id=quote.author_id ";
    $sql.="left join category on category.id=quote.category_id ";
    $position = "where ";
    if ( isset($author) and $author ) {
        $sql.= $position . "author.id=:author ";
        $pdo_values["author"]=$author;
        $position = "and ";
    }
    if ( isset($category) and $category ) {
        $sql.= $position . "category.id=:category ";
        $pdo_values["category"]=$category;
        $position = "and ";
    }
    if ( $approved) $sql.= "and quote.approved=1 ";
    if ( isset($order) and $order ) $sql.= "order by quote.id";
    else $sql.= "order by quote.id";
    if ( $limit ) " limit 0,".$limit;
    $statement = $db->prepare($sql);
    $statement->execute($pdo_values);
    $quotes = $statement->fetchAll();
    $statement->closeCursor();
    return $quotes;
}

function retrieve_all_authors() {
    global $db;
    $sql ="select * from author order by author ";
    $statement = $db->prepare($sql);
    $statement->execute();
    $authors = $statement->fetchAll();
    $statement->closeCursor();
    return $authors;
}

function retrieve_specific_author($id) {
    global $db;
    $sql ="select * from author where id=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($id));
    $author = $statement->fetch();
    $statement->closeCursor();
    return $author;
}

function retrieve_all_categories() {
    global $db;
    $sql ="select id,category from category order by category ";
    $statement = $db->prepare($sql);
    $statement->execute();
    $category = $statement->fetchAll();
    $statement->closeCursor();
    return $category;
}

function retrieve_specific_category($id) {
    global $db;
    $sql ="select * from category where id=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($id));
    $category = $statement->fetch();
    $statement->closeCursor();
    return $category;
}

function add_quote($category, $author, $text, $approved=0) {
    global $db;
    $pdo_values = array("text"=>$text,
                        "category"=>$category,
                        "author"=>$author,
                        "approved"=>$approved
    );
    $sql ="insert into quote values('',:category,:author,:text,:approved);";
    $statement = $db->prepare($sql);
    $statement->execute($pdo_values);
    $statement->closeCursor();
}

function add_author($author) {
    global $db;
    $sql ="insert into author values('',?);";
    $statement = $db->prepare($sql);
    $statement->execute(array($author));
    $statement->closeCursor();
}

function add_category($category) {
    global $db;
    $sql ="insert into category values('',?);";
    $statement = $db->prepare($sql);
    $statement->execute(array($category));
    $statement->closeCursor();
}

function delete_quote($id) {
    global $db;
    $sql ="delete from quote where id=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($id));
    $statement->closeCursor();
}

function delete_category($id) {
    global $db;
    $sql ="delete from category where id=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($id));
    $statement->closeCursor();
}

function delete_author($id) {
    global $db;
    $sql ="delete from author where id=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($id));
    $statement->closeCursor();
}

function approve_quote($id) {
    global $db;
    $sql ="update quote set approved=1 where id=?";
    $statement = $db->prepare($sql);
    $statement->execute(array($id));
    $statement->closeCursor();
}


/*  Normally would have included this in a separate library, but there's only one and that seemed like a waste */
function proper($string) {
    $string = ucwords(strtolower($string));
    return $string;
}
