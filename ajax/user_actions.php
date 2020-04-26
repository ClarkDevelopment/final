<?php
session_start();
require('../model/database.php');
require("../util/validation.php");
require("../model/admin_db.php");

$ajax_response['success'] = 1;
$ajax_response['error_messages'] = array();

if ( !isset($_POST['action']) or !strlen($_POST['action']) ) {
    $ajax_response['success'] = 0;
    $ajax_response['error_messages'][] = "Action type was not received from the client";
}

if (!isset($_POST['username']) or !strlen($_POST['username']) ) {
    $ajax_response['success'] = 0;
    $ajax_response['error_messages'][] = "Invalid Username received from client";
}
else {
    $username = filter_input(INPUT_POST, 'username',FILTER_SANITIZE_STRING	);
    if ( !strlen($username) or strlen($username) < 5 ) {
        $ajax_response['success'] = 0;
        $ajax_response['error_messages'][] = "Invalid name received from client";
    }
    else if ( $_POST['action'] == "register" and username_already_exists($username) ) {
        $ajax_response['success'] = 0;
        //I'd typically do a more vague error message to avoid phishing, but I wanted some distinction between the errors here.
        $ajax_response['error_messages'][] = "This username is already in use";
    }
    else {
        $ajax_response['username'] = ucwords(strtolower($username));
    }
}

if ( $_POST['action'] != "logout" ) {
    if (!isset($_POST['password1']) or !strlen($_POST['password1'])) {
        $ajax_response['success'] = 0;
        $ajax_response['error_messages'][] = "Password was not received from client";
    } else {
        $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
        if ($_POST['action'] == "register") {
            $uppercase = preg_match('@[A-Z]@', $password1);
            //$lowercase = preg_match('@[a-z]@', $password1);
            $number = preg_match('@[0-9]@', $password1);
            if (!strlen($password1) or !$uppercase or !$number or strlen($password1) < 5) {
                $ajax_response['success'] = 0;
                $ajax_response['error_messages'][] = "Invalid password received from client ";
            }
        }
    }
}

if ( $_POST['action'] == "register" ) {
    if (!isset($_POST['password2']) or !strlen($_POST['password2'])) {
        $ajax_response['success'] = 0;
        $ajax_response['error_messages'][] = "Invalid Confirmation Password received from client";
    } else {
        $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);
        if ($password2 !== $password1) {
            $ajax_response['success'] = 0;
            $ajax_response['error_messages'][] = "Your passwords do not match";
        }
    }
}

if ( $ajax_response['success'] ) {
    if ( $_POST['action'] == "register" ) {
        add_admin($username,$password1);
        $_SESSION['is_valid_admin'] = 1;
        $_SESSION['username'] = ucwords(strtolower($username));
    } else if ( $_POST['action'] == "login" ) {
        if ( is_valid_admin_login($username, $password1) ) {
            $_SESSION['is_valid_admin'] = 1 ;
            $_SESSION['username'] = ucwords(strtolower($username));
        }
        else {
            $ajax_response['success'] = 0;
            $ajax_response['error_messages'][] = "We could not find a record matching the submitted credentials";
        }
    } else if ( $_POST['action'] == "logout" ) {
        if ( isset($_SESSION['username']) ) {
            session_destroy();
            unset($_SESSION['username']);
        }
        else {
            $ajax_response['success'] = 1;
            $ajax_response['error_messages'][] = "You are not currently logged in!";
        }
    }
}

print json_encode($ajax_response);
die();
