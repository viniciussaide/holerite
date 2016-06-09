

<div class='well'>
		<div class="input-group pull-right">
			<button class="btn btn-primary" type="submit" name=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nova Função</button></p>
		</div>
		<table class="table table-hover" style="background-color: #FFFFFF;border-radius: 10px;">
			<thead>
				<td class="col-xs-4"><button class="btn btn-link" type="submit" value="Desc_mat" name="order"><b><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> Descrição</b></button></td>
				<td class="col-xs-4"><button class="btn btn-link" type="submit" value="Desc_mat" name="order"><b><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> Nome do Menu</b></button></td>
				<td class="col-xs-4"><button class="btn btn-link" type="submit" value="Desc_mat" name="order"><b><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> Página PHP</b></button></td>
			</thead>
		</table>
	<div class='list-group'>
	<?php
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("Erro ao conectar");
		$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
		mysqli_set_charset($conn, "utf8");
		$query = "SELECT * FROM funcao";
		$result = mysqli_query($conn, $query);
		if ($result){
			while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$id_funcao = $row['id_funcao'];
				$funcao = $row['funcao'];
				$nome_menu = $row['nome_menu'];
				$pagina_php = $row['pagina_php'];
				echo "<button type='button' class='list-group-item'><div class='col-xs-4'>$funcao</div><div class='col-xs-4'>$nome_menu</div><div class='col-xs-4'>$pagina_php</div></button>";
			}
		}
	?>
	</div>
</div>