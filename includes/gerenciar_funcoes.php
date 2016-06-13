<?php
if (isset($_POST['funcao'])){
	$id_funcao = $_POST['funcao'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn, "utf8");
	$query = "SELECT * FROM funcao WHERE id_funcao='$id_funcao'";
	$result = mysqli_query($conn, $query);
	if ($result){
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		$funcao = $row['funcao'];
		$nome_menu = $row['nome_menu'];
		$pagina_php = $row['pagina_php'];
		$prioridade = $row['prioridade'];
		$tipo_menu = $row['tipo_menu'];
		$menu_pai = ctype_digit($tipo_menu);
		if ($menu_pai){
			$query = "SELECT * FROM funcao WHERE id_funcao='$tipo_menu'";
			$result = mysqli_query($conn, $query);
			if ($result){
				$row = mysqli_fetch_array($result, MYSQL_ASSOC);
				$nome_menu_pai = $row['nome_menu'];
			}
		}
		//echo $funcao." - ".$nome_menu." - ".$tipo_menu." - ".$prioridade." - ".$menu_pai."<br>";?>
		<div class="container">
		<form class="form-horizontal" action="?pagina=gerenciar_funcoes.php" method="POST" id="alterar_funcao">
		<input type="hidden" value='<?php echo $id_funcao;?>' name="id_funcao">
		  <div class="form-group">
			<label for="funcao">Função: </label>
			<input type="text" class="form-control" name="nome_funcao" value='<?php echo $funcao;?>'>
		  </div>
		  <div class="form-group">
			<label for="pagina_php">Página PHP: </label>
			<input type="text" class="form-control" name="pagina_php" value='<?php echo $pagina_php;?>'>
		  </div>
		  <div class="form-group">
			<label for="nome_menu">Nome do Menu: </label>
			<input type="text" class="form-control" name="nome_menu" value='<?php echo $nome_menu;?>'>
		  </div>
		  <div class="form-group">
			<label for="tipo_menu">Posição/Tipo do Menu: </label>
			<select class="form-control" name="tipo_menu">
				<option>Simples</option>
				<?php
					$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%superior%' OR tipo_menu LIKE '%lateral%' GROUP BY tipo_menu";
					$result = mysqli_query($conn, $query);
					
					if ($result){
						while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
							$id_funcao = $row['id_funcao'];
							$tipos_menu = $row['tipo_menu'];
							if ($tipos_menu==$tipo_menu){
								echo "<option value='$id_funcao' selected='selected'>$tipos_menu</option>";
							}
							else {
								echo "<option value='$id_funcao'>$tipos_menu</option>";
							}
						}
					}
				?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="nome_menu_pai">Filho de: </label>
			<select class="form-control" value="<?php if (!$menu_pai){echo "--";} else {echo $tipo_menu;}?>" name="menu_pai">
				<option value="">--</option>
				<?php
					$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%Dropdown%'";
					$result = mysqli_query($conn, $query);
					if ($result){
						while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
							$id_funcao_pai = $row['id_funcao'];
							$nome_menu = $row['nome_menu'];
							if ($nome_menu==$nome_menu_pai){
								echo "<option value='$id_funcao_pai' selected='selected'>$nome_menu</option>";
							}
							else {
								echo "<option value='$id_funcao'>$nome_menu</option>";
							}
						}
					}
				?>
			</select>
		  </div>
			<div class="well">
				<label>Permissões</label>
					<?php
					$query = "SELECT * FROM user_type LEFT JOIN relacao_type_funcao ON fk_id_user_type=id_user_type AND fk_id_funcao=$id_funcao";
					$result = mysqli_query($conn, $query);
					while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
						$type = $row['type'];
						$id_user_type = $row['id_user_type'];
						if ($row['id_user_type']==$row['fk_id_user_type']){
							echo "<div class='checkbox'><label><input type='checkbox' name='permissao[]' value='$id_user_type' checked> $type</label></div>";
						}
						else {
							echo "<div class='checkbox'><label><input type='checkbox' name='permissao[]' value='$id_user_type'> $type</label></div>";
						}
					}
					?>
				</label>
			</div>
			
		  <div class="form-group">
			<label for="prioridade">Prioridade: </label>
			<select class="form-control" name="prioridades[]" id="prioridades" multiple>
				<?php
					$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%Dropdown%'";
					$result = mysqli_query($conn, $query);
					if ($result){
						while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
							$id_funcao_pai = $row['id_funcao'];
							$nome_menu_2 = $row['nome_menu'];
							if ($nome_menu==$nome_menu_2){
								echo "<option value='$id_funcao_pai' selected='selected'>$nome_menu_2</option>";
							}
							else {
								echo "<option value='$id_funcao'>$nome_menu_2</option>";
							}
						}
					}
					
				?>
			</select>
			<div id="priority">
				<div><button class="btn btn-default" type="button" id="move-up"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></button></div>
				<div><button class="btn btn-default" type="button" id="move-down"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></button></div>
			</div>
		  </div>
			<div class="pull-right">
			  <button type="submit" class="btn btn-success" name="alterar" id="alterar">Salvar</button>
			  <a href="?pagina=gerenciar_funcoes.php" class="btn btn-danger">Cancelar</a>
			</div>
		</form>
		</div>
	<?php
	}
}
elseif(isset($_POST['nova_funcao'])){
	
}
elseif(isset($_POST['alterar'])){
 	echo "Foi!";
	Kint::dump( $result );
}
else {
	include "includes/lista_funcoes.php";
}
?>