	<li><a href="?pagina=home.php"><b>Home</b></a></li>
	<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
	<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
		<ul class="dropdown-menu dropdown-menu-right">
		<?php
		foreach ($_SESSION['user_type'] as $type) {
			if (($type=='super_admin')||($type=='admin')){
				echo "<li><a href='?pagina=relatorio.php' id='pagina'><b>Relatório de Chaves</b></a></li>";
			}
		}
		?>
		<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
		<li><a href="?pagina=impostoRenda.php" target="_blank"><b>Imposto de Renda</b></a></li>
		</ul>
	</li>
	<li><a href="?pagina=contato.php"><b>Fale Conosco</b></a></li>