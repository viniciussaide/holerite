<div class="jumbotron hidden-xs hidden-print">
	<img class="img-responsive navbar-default" src="imgs/holerite.png" width="80%">
</div>
<div class="container" style="padding-top:15px;">
<?php	
	if(isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	else {
		$pagina = "home.php";
	}
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao WHERE $restricao";
	$result = mysqli_query($conn, $query);
	if ($result){
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$pagina_php = $row['pagina_php'];
			if ($pagina==$pagina_php){
				include "includes/".$pagina_php;
				break;
			}
		}
	}
?>
</div>