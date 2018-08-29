<?php

	define('HOST', 'localhost');
	define('DB', 'vue-todo');
	define('USER', 'root');
	define('PASSWORD', 'root');

	$text = $_POST['text'];


	// First connect to the database
	$conn = new mysqli(HOST, USER, PASSWORD, DB);

	function insert($conn, $text) {

		$sql = "INSERT INTO `todos` (`id`, `text`) VALUES (NULL, '.$text.')";

		if ($conn->query($sql) === TRUE) { 
			echo 'True';
		} else {
			echo 'Failed';
		}
		$conn->close();
		
	}

	function delete($conn, $id) {

		$sql = "DELETE FROM `todos` WHERE id=".$id;

		if ($conn->query($sql) === TRUE) { 

			echo 'True';

		} else {
			echo 'Failed';
		}

		$conn->close();

	}

	function select($conn) {
		header("Content-Type: application/json; charset=UTF-8");

		$response = [];
		$sql = "SELECT * FROM `todos` ORDER BY id DESC";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()) {
			array_push($response, $row);
		}

		return $response;
	}

	// Insert operation
	if ($_POST['text']) {
		insert($conn, $_POST['text']);
		die();
	}

	// Delete operation
	if ($_GET['delete_id']) {
		delete($conn, $_GET['delete_id']);
		die();
	}

	if (isset($_GET)) {
		// Default operation to fetch all record
		print json_encode(select($conn));
	}

?>