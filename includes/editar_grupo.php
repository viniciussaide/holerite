<?php
	$id_user_type = $_SESSION['posts']['seleciona_grupo'];
	$query = "SELECT * FROM user_type WHERE id_user_type='$id_user_type'";
	$result = mysqli_query($conn, $query);
	if ($result){
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		$nome_grupo = $row['type'];
?>
	<div class="container-fluid">
		<form action="?pagina=gerenciar_grupos.php" method="POST">
			<!--Modal apagar Grupo-->
			<div class="modal fade" id="modal_apagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
				<div class="modal-content panel panel-danger">
				  <div class="modal-header panel-heading">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel" align="center"><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Apagar Função</strong></h4>
				  </div>
				  <div class="modal-body panel-body">
					<div align="center">
					<p>Quer realmente apagar o grupo?</p>
					<button type="submit" class="btn btn-danger" name="apagar_grupo"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<!--Fim Modal apagar Grupo-->
			<input type="hidden" value='<?php echo $id_user_type;?>' name="id_user_type" id="id_user_type">
			<div class="row">
				<div class="form-group col-xs-3">
					<label for="nome_grupo">Nome do Grupo: </label>
					<input type="text" class="form-control" name="nome_grupo" id="nome_grupo" value="<?php echo $nome_grupo;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="well form-group">
						<label>Permissões Funções</label>
						<?php
						$query = "SELECT * FROM funcao LEFT JOIN relacao_type_funcao ON fk_id_funcao=id_funcao AND fk_id_user_type='$id_user_type'";
						$result_2 = mysqli_query($conn, $query);
						while($row = mysqli_fetch_array($result_2, MYSQL_ASSOC)){
							$id_funcao = $row['id_funcao'];
							$nome_funcao = $row['funcao'];
							if ($id_user_type==$row['fk_id_user_type']){
								echo "<div class='checkbox'><label><input type='checkbox' name='permissao_funcao[]' value='$id_funcao' checked> $nome_funcao</label></div>";
							}
							else {
								echo "<div class='checkbox'><label><input type='checkbox' name='permissao_funcao[]' value='$id_funcao'> $nome_funcao</label></div>";
							}
						}
						?>
					</div>
				</div>
				<div class="well col-md-8">
					<p align="center"><label>Usuários</label></p>
					<div class="col-md-6 form-group">
						<label>Pertencem ao Grupo</label>
						<select multiple id="select1" size='15' class="form-control" name="permissao_usuarios[]">
							<?php
							$query = "SELECT * FROM relacao_type_user JOIN users ON matricula=fk_matricula WHERE fk_id_user_type='$id_user_type' ORDER BY matricula";
							$result_2 = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_array($result_2, MYSQL_ASSOC)){
								$matricula = $row['matricula'];
								$nome = $row['nome'];
								echo "<option value='$matricula'>$matricula - $nome</option>";
							}
							?>
						</select>
					</div>
					<div class="col-md-6 form-group">
						<label>Não Pertencem ao Grupo</label>
						<select multiple id="select2" size='15' class="form-control">
							<?php
							$query = "SELECT * FROM users WHERE matricula NOT IN (SELECT fk_matricula FROM relacao_type_user WHERE fk_id_user_type=$id_user_type) ORDER BY matricula";
							$result_2 = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_array($result_2, MYSQL_ASSOC)){
								$matricula = $row['matricula'];
								$nome = $row['nome'];
								echo "<option value='$matricula'>$matricula - $nome</option>";
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="well form-group">
						<label>Permissão de Edição de Mensagens</label>
						<?php
						$query = "SELECT * FROM mensagem LEFT JOIN relacao_type_mensagem ON fk_id_mensagem=id_mensagem AND fk_id_user_type='$id_user_type'";
						$result_2 = mysqli_query($conn, $query);
						while($row = mysqli_fetch_array($result_2, MYSQL_ASSOC)){
							$id_mensagem = $row['id_mensagem'];
							$descricao_mensagem = $row['descricao'];
							if ($id_user_type==$row['fk_id_user_type']){
								echo "<div class='checkbox'><label><input type='checkbox' name='permissao_mensagem[]' value='$id_mensagem' checked> $descricao_mensagem</label></div>";
							}
							else {
								echo "<div class='checkbox'><label><input type='checkbox' name='permissao_mensagem[]' value='$id_mensagem'> $descricao_mensagem</label></div>";
							}
						}
						?>
					</div>
				</div>
			</div>
			<div class="pull-right">
				<button type="submit" class="btn btn-success" name="alterar_grupo" id="alterar_grupo">Salvar</button>
				<a href="?pagina=gerenciar_grupos.php" class="btn btn-default">Cancelar</a>
			</div>
			<div class="pull-left">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_apagar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar</button>
			</div>
		</form>
	</div>
	<?php
	}
?>