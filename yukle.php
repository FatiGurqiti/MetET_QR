<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "root", "Product_details");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['submit'])) {
  	// Get image name
  	$image = $_FILES['urun_gorsel']['name'];
  	// Get text
  	//$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO product  VALUES (NULL,'','$image','','')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['urun_gorsel']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM product");
?>