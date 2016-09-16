<nav class="navbar navbar-default navbar-fixed-top hidden-print" style="box-shadow: 0 0 3px 1px #333;">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="index.php"><img class="img-responsive" src="imgs/holeriteNome.png" width="150" style="padding-top:5px;"></a>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
		<?php	
			$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao WHERE ".$_SESSION['query_restricao']." GROUP BY id_funcao ORDER BY prioridade";
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
						$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON fk_id_funcao=id_funcao WHERE tipo_menu=".$id_funcao." AND (".$_SESSION['query_restricao'].") GROUP BY id_funcao ORDER BY prioridade";
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
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		  <?php echo "<b>$_SESSION[primeiro_nome]"." "."$_SESSION[ultimo_nome]"; ?></b>
		  <span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-right">
			<?php
			$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao WHERE ".$_SESSION['query_restricao']." GROUP BY id_funcao ORDER BY prioridade";
			$result = mysqli_query($conn, $query);
			if ($result){
				while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					$id_funcao = $row['id_funcao'];
					$pagina_php = $row['pagina_php'];
					$nome_menu = $row['nome_menu'];
					$tipo_menu = $row['tipo_menu'];
					if ($tipo_menu=='Perfil'){
						echo "<li><a href='?pagina=".$pagina_php."'><b>".$nome_menu."</b></a></li>";
					}
				}
			}
			?>
			<li><a href="index.php?logout"><span class="glyphicon glyphicon-off"></span> <b>Logout</b></a></li>
			</ul>
		</li>		
		</ul>
	</div><!--/.navbar-collapse -->
  </div>
</nav>