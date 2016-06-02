<?php
	if(isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}	       
	@$id = $_REQUEST['id'];
	echo $id;	
	if(@$pagina == ""){?>
			<li class="active"><a href="?pagina=home.php"><b>Home</b></a></li>
			<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
	elseif(($pagina == "home.php")||($pagina == "SenhaSucesso.php")||($pagina == "SenhaErrada.php")
	||($pagina == "SenhaNcombinam.php")||($pagina == "UserErrado.php")){?>
			<li class="active"><a href="?pagina=home.php"><b>Home</b></a></li>
			<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
	elseif(($pagina == "holerite.php")||($pagina == "selectholetite.php")){?>
			<li><a href="?pagina=home.php"><b>Home</b></a></li>
			<li class="active"><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
	elseif(($pagina == "links.php")){?>
			<li><a href="?pagina=home.php"><b>Home</b></a></li>
			<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li class="active"><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
	elseif(($pagina == "contato.php")||($pagina == "email.php")){?>
			<li><a href="?pagina=home.php"><b>Home</b></a></li>
			<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li class="active"><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}	
	elseif($pagina == "form_troca_senha.php"){?>
			<li><a href="?pagina=home.php"><b>Home</b></a></li>
			<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
	elseif($pagina == "selectHolerite.php"){?>
			<li><a href="?pagina=home.php"><b>Home</b></a></li>
			<li class="active"><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
	elseif($pagina == "ChangePassword.php"){?>
			<li  class="active"><a href="?pagina=home.php"><b>Home</b></a></li>
			<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
	elseif(($pagina == "impostoRenda.php")||($pagina == "relatorio.php")||($pagina == "extrato_plr.php")){?>
			<li><a href="?pagina=home.php"><b>Home</b></a></li>
			<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
	else {?>
			<li class="active"><a href="?pagina=home.php"><b>Home</b></a></li>
			<li><a href="?pagina=holerite.php"><b>Holerite</b></a></li>
			<li><a href="?pagina=links.php"><b>Links Úteis</b></a></li> 
			<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b>Serviços</b><span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
				<?php
					if ($_SESSION['user_type']=='admin'){
						echo "<li><a href='?pagina=relatorio.php'><b>Relatório de Chaves</b></a></li>";
					}
				?>
				<li><a href="?pagina=extrato_plr.php"><b>Extrato PLR</b></a></li>
                <li><a href="?pagina=impostoRenda.php" target=_blank><b>Imposto de Renda</b></a></li>
				</ul>
			</li>
			<li><a href="?pagina=contato.php"><b>Fale Conosco</b></b></a></li><?php
	}
?>