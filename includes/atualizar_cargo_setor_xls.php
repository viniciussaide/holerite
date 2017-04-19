<?php
/* error_reporting(E_ALL ^ E_NOTICE);
require "includes/SpreadsheetReader.php";
use \PHPExcelReader\SpreadsheetReader as Reader;

$data = new Reader(__DIR__ . "/example.xls");
$conn = mysqli_connect('localhost', 'root', '') or die ("Erro ao conectar");
$bd = mysqli_select_db($conn, 'holerite_teste') or die ("Não foi possível selecionar o banco de dados.");
mysqli_set_charset($conn, "utf8");
$itens = $data->rowcount($sheet_index=0);
for ($i=2; $i<=$itens;$i++){
	$matricula = $data->val($i,1);
	$setor = $data->val($i,5);
	$cargo = $data->val($i,6);
	$query = "INSERT INTO setor (setor) 
				  SELECT '$setor' AS setor
				  FROM dual
				  WHERE NOT EXISTS
						( SELECT *
						  FROM setor 
						  WHERE setor = '$setor'
						) ;"; 
	mysqli_query($conn, $query);
	$query = "UPDATE users SET cargo='$cargo' WHERE matricula='$matricula';";
	mysqli_query($conn, $query);
	$query = "SELECT * FROM setor WHERE setor='$setor'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	$id_setor = $row['id_setor'];
	$query = "UPDATE users SET fk_id_setor=$id_setor WHERE matricula=$matricula;";
	$result = mysqli_query($conn, $query);
	if ($result){
		echo "Matrícula: $matricula Setor: $setor Cargo: $cargo </br>";
	}
} */
//echo $data->dump(true,true);?>