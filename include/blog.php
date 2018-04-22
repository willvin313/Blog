<?php
//Query functuon
function Q($q, $get_last_id=false){
	$db_host = "";
	$db_user = "";
	$db_password = "";
	$db_name = "";

	$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$done = $conn->query($q);

	if($get_last_id){
		$done = $conn->insert_id;
	}

	return $done;
}

function add_post($title, $contents, $category) {
	// $title 		= $conn->mysqli_real_escape_string($title);
	// $contents 	= $conn->mysqli_real_escape_string($contents);
	$category 	= (int) $category;
	// var_dump($category);

	return Q("INSERT INTO `posts` SET

			`cat_id` 		= '{$category}',
			`title`			= '{$title}',
			`contents`		= '{$contents}',
			`date_posted`	= NOW()", true);

}

function edit_post($id, $title, $contents, $category) {
	$id 		= (int) $id;
	// $title 		= mysqli_real_escape_string($title);
	// $contents 	= mysqli_real_escape_string($contents);
	$category 	= (int) $category;
	Q("UPDATE `posts` SET
	`cat_id`	= {$category},
	`title`		= '{$title}',
	`contents`	= '{$contents}'
	WHERE `id` = {$id} ");

}

function add_category($name) {
	// $name = mysqli_real_escape_string($name);
	//var_dump($name);

	Q("INSERT INTO categories SET name = '{$name}'");
}

function delete($table, $id) {
	// $table = mysqli_real_escape_string($table);
	$id    = (int) $id;
	Q("DELETE FROM `{$table}` WHERE `id` = {$id}");
}

function get_posts($id = null, $cat_id = null) {
	$posts = array();
	$q = "SELECT posts.id AS post_id, categories.id AS category_id, title, contents, date_posted, categories.name FROM posts INNER JOIN categories ON categories.id = posts.cat_id ";
	
	if ( isset($id) ) {
		$id = (int) $id;
		$q .= " WHERE `posts` . `id` = {$id}";
	}

	if (isset($cat_id) ){
		$cat_id = (int) $cat_id;
		$q .= " WHERE `cat_id` = {$cat_id}";
	}

	$q .= " ORDER BY `posts` . `id` DESC";

	$qr = Q($q);

	while ($row = $qr->fetch_assoc() ) {
		$posts[] = $row;
	}

	return $posts;
}

function get_categories($id = null){
	$categories = array();


	$query = Q(" SELECT id, name FROM categories ");

	while ($row = $query->fetch_assoc() ) {
		$categories[] = $row;
	}

	return $categories;
}

function category_exists($field, $value) {
	// $field = mysqli_real_escape_string($conn,$field);
	// $value = mysqli_real_escape_string($conn,$value);
	$q = "SELECT * FROM categories WHERE {$field} = '{$value}' LIMIT 1";
	$query = Q($q);

	// return ( $query->fetch_assoc() == '0' ) ? false : true; 
	return $query->fetch_assoc();
}