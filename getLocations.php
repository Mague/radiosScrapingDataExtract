<?php
require 'dbConnect.php';
if($connect->connect_errno){
	echo "Error al conectar con la base de datos baby";
	return false;
}

$select = "SELECT * FROM paises";

$query = $connect->query($select);
if($query->num_rows > 0){
	while($row = $query->fetch_assoc()){
		$data[] = array_map('utf8_encode', $row);
	}
	header("Content-Type:application/json");
	echo json_encode($data);
}