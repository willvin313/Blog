<?php require_once "include/blog.php"; ?>
<!DOCTYPE html>
	<html lang="en">
<head>
	<title>Category list</title>
	<?php include "include/_head.php" ?>
</head>


<body>
<div class="container">
	<div class="row">
		<div class="span6 offset3">
			<h1>Category List</h1>
			<br>
			<?php include "include/_nav.php" ?>
			<hr>
			<br>
<?php 
foreach  ( get_categories() as $category ) {
		?>
		<p><a href="category.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a> - <a href="delete_category.php?id=<?php echo $category['id']; ?>">Delete</a></p>
		<?php
		}
?>

</div>
</div>
</div>

</body>
</html>

