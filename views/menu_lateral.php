<!-- Left column -->
<div class="row">
	<div class="col-md-2 hidden-print">
	<hr>
	<div align='center'>
		<strong><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Ferramentas</strong>
	</div>
	<hr>
	<ul class="nav nav-stacked">
	<?php
		$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao WHERE ".$_SESSION['query_restricao']." GROUP BY id_funcao ORDER BY prioridade";
		$result = mysqli_query($conn, $query);
		if ($result){
			while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$id_funcao = $row['id_funcao'];
				$pagina_php = $row['pagina_php'];
				$nome_menu = $row['nome_menu'];
				$tipo_menu = $row['tipo_menu'];
				if ($tipo_menu=='Lateral Simples'){
					echo "<li><a href='?pagina=".$pagina_php."'><b>".$nome_menu."</b></a></li>";
				}
				elseif ($tipo_menu=='Lateral Dropdown'){
					echo "<li class='nav-header'><a href=".$pagina_php." data-toggle='collapse' data-target='#".$id_funcao."'><b>".$nome_menu."</b> <span class='glyphicon glyphicon-chevron-down'></span></a><ul class='nav nav-stacked collapse in' id='".$id_funcao."'>";
					$query = "SELECT * FROM funcao JOIN relacao_type_funcao 
								ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao 
								WHERE (".$_SESSION['query_restricao'].") AND  tipo_menu=".$id_funcao." 
								GROUP BY id_funcao
								ORDER BY prioridade";
					$result_2 = mysqli_query($conn, $query);
					if ($result_2){
						while($row_2 = mysqli_fetch_array($result_2, MYSQL_ASSOC)) {
							$pagina_php = $row_2['pagina_php'];
							$nome_menu = $row_2['nome_menu'];
							$tipo_menu = $row_2['tipo_menu'];
							echo "<li><a href='?pagina=".$pagina_php."'>".$nome_menu."</a></li>";
						}
					}
					echo "</ul></li>";
				}
			}
		}
		//echo $restricao;
	?>
	</ul>
	<hr>
	<!-- End Left column -->
	</div>
	<div class="col-md-10">
		<?php include "pagina.php";?>
	</div>
</div>