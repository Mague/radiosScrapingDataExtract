<?php
require 'dbConnect.php';
if($connect->connect_errno){
	echo "Error al conectar con la base de datos";
	return false;
}

$sql = "SELECT * FROM emisoras";
$query = $connect->query($sql);
$all = array();
$all['categories'] = array();
$all['radios'] = array();
function none($n){
	return $n;
}
if($query->num_rows > 0){
	while($row = $query->fetch_assoc()){
		$data = array_map('none', $row);
		$c = array();
		$aux = explode(',',$data['genero']);
		foreach ($aux as $value) {
			$val = trim($value);
			if(!in_array($val,$all['categories'])){
				$all['categories'][] = $val;
				$c[] = $val;
			}
		}
		$data['generos'] = $aux;
		$all['radios'][] = $data;
	}
	sort($all['categories']);
	header("Content-Type:application/json");
	echo json_encode($all);
	// echo json_encode($data);
}