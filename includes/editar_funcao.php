<?php
	$id_funcao = $_SESSION['posts']['editar_funcao'];
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
?>


	<div class="container-fluid">
		<form action="?pagina=gerenciar_funcoes.php" method="POST">
		<!--Modal apagar Funcao-->
			<div class="modal fade" id="modal_apagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog " role="document" style="width:300px;margin-top:-150px;margin-left:-150px;">
				<div class="modal-content panel panel-danger">
				  <div class="modal-header panel-heading">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel" align=center><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Apagar Função</strong></h4>
				  </div>
				  <div class="modal-body panel-body">
					<div align="center">
					<p>Quer realmente apagar a função?</p>
					<button type="submit" class="btn btn-danger" name="apagar_funcao"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		<!--Fim Modal apagar Funcao-->
			<input type="hidden" value='<?php echo $id_funcao;?>' name="id_funcao" id="id_funcao">
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="funcao">Função: </label>
					<input type="text" class="form-control" name="nome_funcao" id="nome_funcao" value='<?php echo $funcao;?>'>
				</div>
				<div class="form-group">
					<label for="nome_menu">Nome do Menu: </label>
					<input type="text" class="form-control" name="nome_menu" value='<?php echo $nome_menu;?>'>
				</div>
				<div class="form-group">
					<label for="nome_menu_pai">Filho de: </label>
					<select class="form-control" name="menu_pai" id="priority_changer">
						<option value="--">--</option>
						<?php
							$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%Dropdown%'";
							$result = mysqli_query($conn, $query);
							if ($result){
								while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
									$id_funcao_pai = $row['id_funcao'];
									$nome_menu_pai = $row['nome_menu'];
									if ($tipo_menu==$id_funcao_pai){
										echo "<option value='$id_funcao_pai' selected='selected'>$nome_menu_pai</option>";
									}
									else {
										echo "<option value='$id_funcao_pai'>$nome_menu_pai</option>";
									}
								}
							}
						?>
					</select>
				</div>
				<div class="well form-group">
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
			  </div>
			  <div class="col-md-6">
				<div class="form-group">
					<label for="pagina_php">Página PHP: </label>
					<input type="text" class="form-control" name="pagina_php" value='<?php echo $pagina_php;?>'>
				</div>
				<div class="form-group">
					<label for="tipo_menu">Posição/Tipo do Menu: </label>
					<select class="form-control" name="tipo_menu" id="priority_changer_2">
						<option>--</option>
						<?php
							$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%superior%' OR tipo_menu LIKE '%lateral%' OR tipo_menu LIKE '%perfil%' GROUP BY tipo_menu";
							$result = mysqli_query($conn, $query);
							if ($result){
								while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
									$id_funcao_lista = $row['id_funcao'];
									$tipos_menu = $row['tipo_menu'];
									if ($tipos_menu==$tipo_menu){
										echo "<option value='$tipos_menu' selected='selected'>$tipos_menu</option>";
									}
									else {
										echo "<option value='$tipos_menu'>$tipos_menu</option>";
									}
								}
							}
						?>
					</select>
				</div>
				<label>Prioridade: </label>
				<div class="form-group" id="priority" >
					<div class="form-group col-md-10" id="select_priority">
						<select class="form-control" name="prioridades[]" id="prioridades" size='11' multiple>
							<?php
								if (($tipo_menu=="Lateral Simples")OR($tipo_menu=="Lateral Dropdown")){
									$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%lateral%' ORDER BY prioridade";
								}
								elseif (($tipo_menu=="Superior Simples")OR($tipo_menu=="Superior Dropdown")){
									$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%superior%' ORDER BY prioridade";
								}
								else {
									$query = "SELECT * FROM funcao WHERE tipo_menu='$tipo_menu' ORDER BY prioridade";
								}
								$result = mysqli_query($conn, $query);
								if ($result){
									while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
										$id_funcao_lista = $row['id_funcao'];
										$nome_menu = $row['nome_menu'];
										if ($id_funcao==$id_funcao_lista){
											echo "<option value='$id_funcao_lista' selected='selected'>$nome_menu</option>";
										}
										else {
											echo "<option value='$id_funcao_lista'>$nome_menu</option>";
										}
									}
								}
								
							?>
						</select>
					</div>
					<div class="form-group col-md-2">
						<div><button class="btn btn-default btn-block" type="button" id="move-up"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></button></div>
						<div><button class="btn btn-default btn-block" type="button" id="move-down"><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></button></div>
					</div>
				</div>
			</div>
		</div>
			<div class="pull-right">
				<button type="submit" class="btn btn-success" name="alterar_funcao" id="alterar_funcao">Salvar</button>
				<a href="?pagina=gerenciar_funcoes.php" class="btn btn-default">Cancelar</a>
			</div>
			<div class="pull-left">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_apagar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar</button>
			</div>
		</form>
	</div>
	<?php
	}
?>