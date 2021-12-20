<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		include 'connection.php';

		$userid = $_POST['userid'];
		$profile_image = $_POST['profile_image'];
		$reduced_profile_image = $_POST['reduced_profile_image'];

		// Retrieving name of old profile image.
		$sql1 = "SELECT profile_image FROM users WHERE userid=:userid";
		$stmt1 = $conn->prepare($sql1);
		$stmt1->execute(array(":userid" => $userid));
		$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		$old_image_name = $row1['profile_image'];
		$old_image_path = "static/profile_images/".$old_image_name;
		$old_reduced_image_path = "static/reduced_profile_images/".$old_image_name;

		// Deleting old profile image.
		if($old_image_name !== null) {
			if(file_exists($old_image_path))
				unlink($old_image_path);
			if(file_exists($old_reduced_image_path))
				unlink($old_reduced_image_path);
		}

		// Updating name of new profile image.
		$image_name = $userid . rand(111111, 999999) . ".jpg";
		$image_path = "static/profile_images/".$image_name;
		$reduced_image_path = "static/reduced_profile_images/".$image_name;
		$sql2 = "UPDATE users SET profile_image='$image_name' WHERE userid=:userid";
		$stmt2 = $conn->prepare($sql2);
		$stmt2->execute(array(":userid" => $userid));

		// Saving new profile image.
		file_put_contents($image_path, base64_decode($profile_image));
		file_put_contents($reduced_image_path, base64_decode($reduced_profile_image));

		echo strval($image_name);
	}
?>
