<?php
require('model/database.php');
require('model/quote_model.php');

$action = filter_input(INPUT_GET, 'action');
$public = 1;

if ( $action == "sort" ) {
    $authorSort = filter_input(INPUT_POST, 'author');
    $categorySort = filter_input(INPUT_POST, 'category');
    $formSort = filter_input(INPUT_POST, 'formSort');
    $origin = filter_input(INPUT_POST, 'origin');
    $approved = 1;

    $quotes = retrieve_sorted_quote_list($authorSort, $categorySort, $formSort, $approved);
    $authors = retrieve_all_authors();
    $categories = retrieve_all_categories();
    if ($origin == "admin")
        include("view/admin.php");
    else
        include("view/index.php");
} else if ( $action == "request_quote" ) {
    $category = filter_input(INPUT_POST, 'category');
    $author = filter_input(INPUT_POST, 'author');
    $text = filter_input(INPUT_POST, 'text');
    $approved = 0;

    add_quote($category, $author, $text, $approved);

    $quotes = retrieve_default_quote_list($public);
    $categories = retrieve_all_categories();
    $authors = retrieve_all_authors();
    include("view/index.php");
} else {
    $formSort = 0;
    $quotes = retrieve_default_quote_list($public);
    $categories = retrieve_all_categories();
    $authors = retrieve_all_authors();
    include("view/index.php");
}
