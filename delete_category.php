<?php 
require_once "include/blog.php";

if ( ! isset($_GET['id']) ) {
	header('location: index.php');
	die();
}

delete('categories', $_GET['id']);

header('location: category_list.php');
die();
