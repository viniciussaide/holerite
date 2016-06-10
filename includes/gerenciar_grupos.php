<?php
if (isset($_POST['user_type'])){
	$id_user_type = $_POST['user_type'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn, "utf8");
	$query = "SELECT * FROM user_type WHERE id_user_type='$id_user_type'";
	$result = mysqli_query($conn, $query);
	if ($result){
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$type = $row['type'];
			$query = "SELECT * FROM relacao_type_funcao JOIN funcao ON fk_id_funcao=id_funcao WHERE fk_id_user_type='$id_user_type'";
			$result_2 = mysqli_query($conn, $query);
			//Kint::dump( $result_2 );
			$funcoes = '';
			if ($result_2){
				while($row_2 = mysqli_fetch_array($result_2, MYSQL_ASSOC)) {
					$funcoes .= $row_2['funcao']."<br>";
				}
			}
			$query = "SELECT * FROM relacao_type_user JOIN users ON matricula=fk_matricula WHERE fk_id_user_type='$id_user_type'";
			$result_2 = mysqli_query($conn, $query);
			$usuarios = '';
			while($row_2 = mysqli_fetch_array($result_2, MYSQL_ASSOC)){
				$usuarios .= $row_2['matricula']." - ". $row_2['nome']."</br>";
			}
			echo "<div class='col-xs-4'>$type</div><div class='col-xs-4'>$funcoes</div><div class='col-xs-4'>$usuarios</div>";
		}
	}
}
elseif(isset($_POST['novo_user_type'])){
	
}
else {
	include "includes/lista_grupos.php";
}
?>