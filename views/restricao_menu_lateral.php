<?php
	$query = "SELECT * FROM funcao JOIN relacao_type_funcao 
	ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao 
	WHERE (".$_SESSION['query_restricao'].") AND  tipo_menu LIKE '%lateral%' 
	ORDER BY prioridade";
	$result = mysqli_query($conn, $query);
	if (($result)AND(mysqli_num_rows($result)>=1)){
		include "views/menu_lateral.php";
	}
	else{
		include "pagina.php";
	}
?>


