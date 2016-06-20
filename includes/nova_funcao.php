<div class="container-fluid">
	<form action="?pagina=gerenciar_funcoes.php" method="POST">
		<input type="hidden" value='' name="id_funcao" id="id_funcao">
		<div class="col-md-6">
			<div class="form-group">
				<label for="funcao">Função: </label>
				<input type="text" class="form-control" name="nome_funcao" id="nome_funcao">
			</div>
			<div class="form-group">
				<label for="nome_menu">Nome do Menu: </label>
				<input type="text" class="form-control" name="nome_menu">
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
								echo "<option value='$id_funcao_pai'>$nome_menu_pai</option>";
							}
						}
					?>
				</select>
			</div>
			<div class="well form-group">
				<label>Permissões</label>
					<?php
					$query = "SELECT * FROM user_type";
					$result = mysqli_query($conn, $query);
					while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
						$type = $row['type'];
						$id_user_type = $row['id_user_type'];
						echo "<div class='checkbox'><label><input type='checkbox' name='permissao[]' value='$id_user_type'> $type</label></div>";
					}
					?>
				</label>
			</div>
		  </div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="pagina_php">Página PHP: </label>
				<input type="text" class="form-control" name="pagina_php">
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
								echo "<option value='$tipos_menu'>$tipos_menu</option>";
							}
						}
					?>
				</select>
			</div>
			<label>Prioridade: </label>
			<div class="form-group" id="priority" >
				<div style="width:90%" class="form-group pull-left" id="select_priority">
					<select style="height:200px" class="form-control" name="prioridades[]" id="prioridades" size='11' multiple>
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
									echo "<option value='$id_funcao_lista'>$nome_menu</option>";
								}
							}
							
						?>
					</select>
				</div>
				<div style="width:10% height:10px" class="form-group pull-right">
					<div>
						<button style="height:100px" class="btn btn-default" type="button" id="move-up">
							<span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
						</button>
					</div>    
					<div>
						<button style="height:100px" class="btn btn-default" type="button" id="move-down">
							<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
						</button>
					</div>
				</div>
			</div>
			<div class="form-group pull-right">
				<button type="submit" class="btn btn-success" name="salvar_nova_funcao" id="salvar_nova_funcao">Salvar</button>
				<a href="?pagina=gerenciar_funcoes.php" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form>
</div>