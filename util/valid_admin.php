<?php
session_start();
if ( !isset($_SESSION['is_valid_admin']) or !$_SESSION['is_valid_admin'] or
     !isset($_SESSION['username']) or !strlen($_SESSION['username']) ) {
    header('Location: index.php');
}