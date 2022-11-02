<?php

session_start();

include('config.php');

function query($query) {
	global $connection;
	$result = mysqli_query($connection, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}
function all($table) {
  $result = query("SELECT * FROM $table ORDER BY id DESC");
	return $result;
}

function select($table, $selects) {
	$selects = join(", ", $selects);
  $result = query("SELECT $selects FROM $table ORDER BY id DESC");
	return $result;
}


function find($table, $id) {
	$result = query("SELECT * FROM $table WHERE id = $id");
	return $result[0];
}

function store($table, $data = [], $is_return_id = false) {
	global $connection;
	$data = count($data) > 0 ? $data : $_POST;
	$fields = [];
	$values = [];
	foreach ($data as $key => $value) {
		$value = htmlspecialchars($value);
		$fields[] = $key;
		$values[] = "'$value'";
	}
	$fields = join(", ", $fields);
	$values = join(", ", $values);
	$query = "INSERT INTO $table ($fields) VALUES ($values)";
	$result = mysqli_query($connection, $query);
	return $is_return_id ? mysqli_insert_id($connection) : mysqli_affected_rows($connection) > 0;
	
}

function update($table, $data = []) {
	global $connection;
	$data = count($data) > 0 ? $data : $_POST;
	$id = $data['id'];
	$values = [];
	foreach ($data as $key => $value) {
		$value = htmlspecialchars($value);
		$values[] = "$key = '$value'";
	}
	$values = join(", ", $values);
	$query = "UPDATE $table SET $values WHERE id = $id";
	mysqli_query($connection, $query);
	return mysqli_affected_rows($connection) > 0;
}

function delete($table, $id) {
	global $connection;
	mysqli_query($connection, "DELETE FROM $table WHERE id = $id");
	return mysqli_affected_rows($connection) > 0;
}

function flash($message, $type) {
	$_SESSION['flash'][$type] = $message;
}