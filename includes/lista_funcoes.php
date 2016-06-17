<?php
if (isset($_SESSION['posts']['order'])){
	$_SESSION['order'] = $_SESSION['posts']['order'];
	if ($_SESSION['order']=='Desc_descricao'){
		$order = 'ORDER BY funcao DESC';
	}
	elseif ($_SESSION['order']=='Desc_nome_menu'){
		$order = 'ORDER BY nome_menu DESC';
	}
	elseif ($_SESSION['order']=='Desc_pagina_php'){
		$order = 'ORDER BY pagina_php DESC';
	}
	elseif ($_SESSION['order']=='Asc_descricao'){
		$order = 'ORDER BY funcao ASC';
	}
	elseif ($_SESSION['order']=='Asc_nome_menu'){
		$order = 'ORDER BY nome_menu ASC';
	}
	elseif ($_SESSION['order']=='Asc_pagina_php'){
		$order = 'ORDER BY pagina_php ASC';
	}
	else {
		$order = 'ORDER BY funcao ASC';
	}
}
else {
	if (!isset($_SESSION['order'])){
		$_SESSION['order'] = '';
	}
	if ($_SESSION['order']=='Desc_descricao'){
		$order = 'ORDER BY funcao DESC';
	}
	elseif ($_SESSION['order']=='Desc_nome_menu'){
		$order = 'ORDER BY nome_menu DESC';
	}
	elseif ($_SESSION['order']=='Desc_pagina_php'){
		$order = 'ORDER BY pagina_php DESC';
	}
	elseif ($_SESSION['order']=='Asc_descricao'){
		$order = 'ORDER BY funcao ASC';
	}
	elseif ($_SESSION['order']=='Asc_nome_menu'){
		$order = 'ORDER BY nome_menu ASC';
	}
	elseif ($_SESSION['order']=='Asc_pagina_php'){
		$order = 'ORDER BY pagina_php ASC';
	}
	else {
		$order = 'ORDER BY funcao ASC';
	}
}
?>
<form action="?pagina=gerenciar_funcoes.php" method="POST">
	<div class='well'>
		<div class="input-group pull-right">
			<button class="btn btn-primary" type="submit" name="nova_funcao"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nova Função</button></p>
		</div>
		<table class="table table-hover" style="background-color: #FFFFFF;border-radius: 10px;">
			<thead>
				<?php
				if (!isset($_SESSION['order'])){
					echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Desc_descricao' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Descrição</b></button></td>";
					echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Desc_nome_menu' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Nome do Menu</b></button></td>";
					echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Desc_pagina_php' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Página PHP</b></button></td>";
				}
				else {
					if ($_SESSION['order']=='Desc_descricao'){
						echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Asc_descricao' name='order'><b><span class='glyphicon glyphicon-menu-up' aria-hidden='true'></span> Descrição</b></button></td>";
					}
					else {
						echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Desc_descricao' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Descrição</b></button></td>";
					}
					if ($_SESSION['order']=='Desc_nome_menu'){
						echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Asc_nome_menu' name='order'><b><span class='glyphicon glyphicon-menu-up' aria-hidden='true'></span> Nome do Menu</b></button></td>";
					}
					else {
						echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Desc_nome_menu' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Nome do Menu</b></button></td>";
					}
					if ($_SESSION['order']=='Desc_pagina_php'){
						echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Asc_pagina_php' name='order'><b><span class='glyphicon glyphicon-menu-up' aria-hidden='true'></span> Página PHP</b></button></td>";
					}
					else {
						echo "<td class='col-xs-4'><button class='btn btn-link' type='submit' value='Desc_pagina_php' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Página PHP</b></button></td>";
					}
				}
				?>
			</thead>
		</table>
		<div class='list-group'>
		<?php
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("Erro ao conectar");
			$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
			mysqli_set_charset($conn, "utf8");
			$query = "SELECT * FROM funcao $order";
			$result = mysqli_query($conn, $query);
			if ($result){
				while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					$id_funcao = $row['id_funcao'];
					$funcao = $row['funcao'];
					$nome_menu = $row['nome_menu'];
					$pagina_php = $row['pagina_php'];
					echo "<button type='submit' class='list-group-item' value='$id_funcao' name='editar_funcao'><div class='col-xs-4'>$funcao</div><div class='col-xs-4'>$nome_menu</div><div class='col-xs-4'>$pagina_php</div></button>";
				}
			}
		?>
		</div>
	</div>
</form>