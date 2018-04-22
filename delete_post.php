<?php 
require_once "include/blog.php"; 

if ( ! isset($_GET['id']) ) {
	header('location: index.php');
	die();
}

delete('posts', $_GET['id']);

header('location: index.php');
die();

?>