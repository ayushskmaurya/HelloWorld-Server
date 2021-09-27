<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		include 'connection.php';

		$user_id = $_POST['userid'];

		$sql = "SELECT chats.chatid, users.name, messages.message, messages.dateTime ";
		$sql .= "FROM chats ";
		$sql .= "INNER JOIN users ";
		$sql .= "ON (CASE WHEN chats.user1id=:user_id THEN chats.user2id WHEN chats.user2id=:user_id THEN chats.user1id END) = users.userid ";
		$sql .= "INNER JOIN (SELECT chatid, max(dateTime) AS mDateTime FROM messages GROUP BY chatid) AS maxDateTime ";
		$sql .= "ON chats.chatid = maxDateTime.chatid ";
		$sql .= "INNER JOIN messages ";
		$sql .= "ON maxDateTime.chatid = messages.chatid AND maxDateTime.mDateTime = messages.dateTime ";
		$sql .= "ORDER BY messages.dateTime DESC";

		$stmt = $conn->prepare($sql);
		$stmt->execute(array("user_id" => $user_id));

		$res = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			array_push($res, $row);
		
		header('Content-Type: application/json');
		echo json_encode($res);
	}
?>
