<?php
require 'dbConnect.php';
if($connect->connect_errno){
	echo "Error al conectar con la base de datos";
	return false;
}

$sql = "SELECT genero FROM emisoras";
$query = $connect->query($sql);
$categories = array();
function none($n){
	return $n;
}
if($query->num_rows > 0){
	while($row = $query->fetch_assoc()){
		$data = array_map('none', $row);
		$aux = explode(',',$data['genero']);
		foreach ($aux as $value) {
			$val = trim($value);
			if(!in_array($val,$categories)){
				$categories[] = $val;
			}
		}
	}
	sort($categories);
	header("Content-Type:application/json");
	echo json_encode($categories);
	// echo json_encode($data);
}