<?php	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn, "utf8");
	$restricao = '';
	foreach ($_SESSION['user_type'] as $type){
		if ($restricao<>''){
			$restricao .= " OR ";
		}
		$restricao .= "fk_id_user_type = $type";
	}
	$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao WHERE $restricao ORDER BY prioridade";
	$result = mysqli_query($conn, $query);
	if ($result){
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$id_funcao = $row['id_funcao'];
			$pagina_php = $row['pagina_php'];
			$nome_menu = $row['nome_menu'];
			$tipo_menu = $row['tipo_menu'];
			if ($tipo_menu=='Superior Simples'){
				echo "<li><a href='?pagina=".$pagina_php."'><b>".$nome_menu."</b></a></li>";
			}
			elseif ($tipo_menu=='Superior Dropdown'){
				echo "<li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><b>".$nome_menu."</b><span class='caret'></span></a><ul class='dropdown-menu dropdown-menu-right'>";
				$query = "SELECT * FROM funcao WHERE tipo_menu=".$id_funcao." ORDER BY prioridade";
				$result_2 = mysqli_query($conn, $query);
				while($row_2 = mysqli_fetch_array($result_2, MYSQL_ASSOC)) {
					$pagina_php = $row_2['pagina_php'];
					$nome_menu = $row_2['nome_menu'];
					$tipo_menu = $row_2['tipo_menu'];
					echo "<li><a href='?pagina=".$pagina_php."'><b>".$nome_menu."</b></a></li>";
				}
				echo "</ul></li>";
			}
		}
	}
?>