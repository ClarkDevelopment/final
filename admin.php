<?php
require('util/valid_admin.php');
require('model/database.php');
require('model/quote_model.php');

$action = filter_input(INPUT_GET, 'action');

if ($action == "delete_quote") {
    $id = round($_GET['id'], 0);
    if (isset($id) and $id) {
        delete_quote($id);
    }

    $quotes = retrieve_default_quote_list();
    $authors = retrieve_all_authors();
    $categories = retrieve_all_categories();
    include("view/admin.php");
} else if ($action == "delete_author") {
    $id = round($_GET['id'], 0);
    if (isset($id) and $id) {
        delete_author($id);
    }

    $authors = retrieve_all_authors();
    include("view/author.php");
} else if ($action == "delete_category") {
    $id = round($_GET['id'], 0);
    if (isset($id) and $id) {
        delete_category($id);
    }

    $categories = retrieve_all_categories();
    include("view/category.php");
} else if ($action == "sort") {
    $authorSort = filter_input(INPUT_POST, 'author');
    $categorySort = filter_input(INPUT_POST, 'category');
    $formSort = filter_input(INPUT_POST, 'formSort');
    $approved = 1;

    $quotes = retrieve_sorted_quote_list($authorSort, $categorySort, $formSort, $approved);
    $authors = retrieve_all_authors();
    $categories = retrieve_all_categories();
        include("view/admin.php");
} else if ($action == "add_quote") {
    $category = filter_input(INPUT_POST, 'category');
    $author = filter_input(INPUT_POST, 'author');
    $text = filter_input(INPUT_POST, 'text');
    $approved = 1;

    add_quote($category, $author, $text, $approved);

    $quotes = retrieve_default_quote_list();
    $categories = retrieve_all_categories();
    $authors = retrieve_all_authors();
    include("view/admin.php");
} else if ($action == "add_author") {
    $authorAdd = filter_input(INPUT_GET, 'author');
    add_author($authorAdd);
    $authors = retrieve_all_authors();
    include("view/author.php");
} else if ($action == "add_category") {
    $categoryAdd = filter_input(INPUT_GET, 'category');
    add_category($categoryAdd);
    $categories = retrieve_all_categories();
    include("view/category.php");
} else if ($action == "view_categories") {
    $categories = retrieve_all_categories();
    include("view/category.php");
} else if ($action == "view_authors") {
    $authors = retrieve_all_authors();
    include("view/author.php");
} else if ($action == "approve_quote") {
    $id = filter_input(INPUT_GET, 'id');
    approve_quote($id);

    $formSort = 0;
    $quotes = retrieve_default_quote_list();
    $categories = retrieve_all_categories();
    $authors = retrieve_all_authors();
    include("view/admin.php");
} else {
    $formSort = 0;
    $quotes = retrieve_default_quote_list();
    $categories = retrieve_all_categories();
    $authors = retrieve_all_authors();
    include("view/admin.php");
}
