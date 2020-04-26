<?php
require('../model/database.php');
require("../model/quote_model.php");

/*
 * Really ugly approach. I really should have broken this up into classes, but it'll work!
 * I was much less worried about double checking for valid author and category Ids fo GET requests, but I did want to
 * make sure they were valid before doing any inserts.
 */

$method = $_SERVER['REQUEST_METHOD'];
$return_data = array();
$errors = array();
$public = 1;
$approved = 1;

switch ($method) {
    case 'POST':
        $author = filter_input(INPUT_POST, 'authorId');
        $category = filter_input(INPUT_POST, 'categoryId');
        $text = filter_input(INPUT_POST, 'text');
        $author = round($author);
        $category = round($category);


        if ( !isset($author) or !$author ) {
            $errors[] = array("msg"=>"authorId was not included");
        }
        else {
            $authorResults = retrieve_specific_author($author);
            if ( !$authorResults ) $errors[] = array("msg"=>"Invalid Author Id received");
        }
        if ( !isset($category) or !$category ) {
            $errors[] = array("msg" => "categoryId was not included");
        }
        else {
            $categoryResults = retrieve_specific_category($category);
            if ( !$categoryResults ) $errors[] = array("msg"=>"Invalid Category Id received");
        }
        if ( !isset($text) or !strlen($text) ) {
            $errors[] = array("msg"=>"text was not included");
        }
        if ( !count($errors) ) {
            add_quote($category, $author, $text,0);
            $return_data = array("msg"=>"Successfully added your quote request! It is now awaiting approval");
        }
        else $return_data = $errors;
        print json_encode($return_data);
        break;
    case 'GET':
        if ( isset($_GET['authorId']) and isset($_GET['categoryId']) ) {
            $author = filter_input(INPUT_GET, 'authorId');
            $category = filter_input(INPUT_GET, 'categoryId');

            $return_data = retrieve_api_sorted_quote_list($author, $category, 0, $approved);
        }
        else if ( isset($_GET['authorId']) ) {
            if ( strtoupper($_GET['authorId']) == "ALL" )
                $return_data = retrieve_all_authors();
            else {
                $author = filter_input(INPUT_GET, 'authorId');
                $return_data = retrieve_api_sorted_quote_list($author, 0 , 0, $approved);
            }
        }
        else if ( isset($_GET['categoryId']) ) {
            if ( strtoupper($_GET['categoryId']) == "ALL" )
                $return_data = retrieve_all_categories();
            else {
                $category = filter_input(INPUT_GET, 'categoryId');
                $return_data = retrieve_api_sorted_quote_list(0, $category, 0, $approved);
            }
        }
        else if ( isset($_GET['limit']) ) {
            $limit = round($_GET['limit']);
            $return_data = retrieve_api_sorted_quote_list(0, 0, 0, $approved, $limit);
        }
        else {
            $return_data = retrieve_api_default_quote_list($public);
        }
        if ( !count($return_data) ) $return_data = array("msg"=>"No results were found matching your criteria");

        if ( isset( $_GET['random']) and $_GET['random'] == true and count($return_data) ) {
            $results_count = count($return_data) - 1;
            $random_key = rand(0,$results_count);
            $return_data = $return_data[$random_key];
        }
        print json_encode($return_data);
        break;
    default:
        $return_data = array("msg"=>"Invalid protocol");
        print json_encode($return_data);
        break;
}
