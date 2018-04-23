<?php 
  try{	
	require_once ('../pdo_config.php');
	$sql = 'SELECT COUNT(image_id) FROM JJ_images';
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$numrows = $stmt->fetchColumn(); //PDO method to retrieve one value only
	$randomRow = mt_rand(0, $numrows-1); //Mersenne Twister algorithm
	$sql2 = "SELECT filename, caption FROM JJ_images LIMIT $randomRow, 1"; //Choose 1 row with a random offset 
	$stmt2 = $conn->prepare($sql2);
	$stmt2->bindValue(':randomRow', $randomRow);
	$stmt2->execute();
	$result = $stmt2->fetch();
	$image = $result['filename'];
	$caption = $result['caption'];
	$imagePath = 'images/'.$image;
	if (file_exists($imagePath)){
		$imageSize=getimagesize($imagePath);
		}
  } catch (PDOException $e) { 
		echo $e->getMessage(); 
		exit();
	}
?>
