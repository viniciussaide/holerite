<div style="padding-top:15px;">
<?php	
	$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao WHERE ".$_SESSION['query_restricao'];
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