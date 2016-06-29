<?php
$id_mensagem = $_SESSION['posts']['seleciona_mensagem'];
$query = "SELECT * FROM mensagem WHERE id_mensagem=$id_mensagem";
$result = mysqli_query($conn, $query);
if($result){
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	$titulo = $row['titulo'];
	$descricao = $row['descricao'];
	$mensagem = $row['mensagem'];
	$data_inicio = $row['data_inicio'];
	if ($data_inicio<>''){
		$data_inicio = substr($data_inicio,8,2)."/".substr($data_inicio,5,2)."/".substr($data_inicio,0,4);
	}
	$data_fim = $row['data_fim'];
	if ($data_fim<>''){
		$data_fim = substr($data_fim,8,2)."/".substr($data_fim,5,2)."/".substr($data_fim,0,4);
	}
	$tela_inicial = $row['tela_inicial'];
	?>
	<form action="?pagina=gerenciar_mensagens.php" method="POST">
		<!--Modal apagar Funcao-->
		<div class="modal fade" id="modal_apagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog " role="document" style="width:300px;margin-top:-150px;margin-left:-150px;">
			<div class="modal-content panel panel-danger">
			  <div class="modal-header panel-heading">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel" align="center"><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Apagar Mensagem</strong></h4>
			  </div>
			  <div class="modal-body panel-body">
				<div align="center">
				<p>Quer realmente apagar a mensagem?</p>
				<button type="submit" class="btn btn-danger" name="apagar_mensagem"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<!--Fim Modal apagar Funcao-->
		<input type="hidden" name="id_mensagem" value="<?php echo $id_mensagem;?>"></input>
		<div class="col-md-4">
			<div class="well">
				<div class="form-group">
					<label>Título</label>
					<input type="text" class="form-control" name="titulo" placeholder="Título" value="<?php echo $titulo;?>"></input>
				</div>
				<div class="form-group">
					<label>Descrição</label>
					<textarea class="form-control" name="descricao" placeholder="Descrição" rows="3" maxlength="300" style="resize: none;"><?php echo $descricao;?></textarea>
				</div>
				<div class="form-group">
					<label>Mensagem</label>
					<textarea class="form-control" name="mensagem" placeholder="Mensagem" rows="5" maxlength="2500" style="resize: none;"><?php echo $mensagem;?></textarea>
				</div>
				<div class="form-group">
					<label>Data Início: </label><input class="form-control" type="text" name="data_inicio" id="data_inicio" value="<?php echo $data_inicio;?>">
				</div>
				<div class="form-group">
					<label>Data Fim: </label><input class="form-control" type="text" name="data_fim" id="data_fim" value="<?php echo $data_fim;?>">
				</div>
				<?php 
				if ($tela_inicial==true){
					echo "<label><input type='checkbox' name='tela_inicial' checked> Mensagem na Tela Inicial</label>";
				}
				else {
					echo "<label><input type='checkbox' name='tela_inicial'> Mensagem na Tela Inicial</label>";
				}
				?>
			</div>
		</div>
		<div class="well col-md-8">
			<div>
				<label>Permissão para Editar Mensagem</label>
					<?php
					$query = "SELECT * FROM user_type LEFT JOIN relacao_type_mensagem ON fk_id_user_type=id_user_type AND fk_id_mensagem='$id_mensagem' AND (".$_SESSION['query_restricao'].") GROUP BY id_user_type";
					$result = mysqli_query($conn, $query);
					while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
						$type = $row['type'];
						$id_user_type = $row['id_user_type'];
						if ($row['fk_id_mensagem']==$id_mensagem){
							echo "<div class='checkbox'><label><input type='checkbox' name='permissao[]' value='$id_user_type' checked> $type</label></div>";
						}
						elseif($row['id_user_type']<>'2') {
							echo "<div class='checkbox'><label><input type='checkbox' name='permissao[]' value='$id_user_type'> $type</label></div>";
						}
					}
					?>
				<p align="center"><label>Usuários</label></p>
				<div class="col-md-6 form-group">
					<label>Mostrar Mensagem para:</label>
					<select multiple id="select1" size='20' class="form-control" name="permissao_usuarios[]">
						<?php
						$query = "SELECT * FROM relacao_mensagem_user JOIN users ON matricula=fk_matricula WHERE fk_id_mensagem='$id_mensagem' ORDER BY matricula";
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
					<label>Não Mostrar Mensagem para:</label>
					<select multiple id="select2" size='20' class="form-control">
						<?php
						$query = "SELECT * FROM users WHERE matricula NOT IN (SELECT fk_matricula FROM relacao_mensagem_user WHERE fk_id_mensagem='$id_mensagem') ORDER BY matricula";
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
		<div class="form-inline pull-right">
			<button name='alterar_mensagem' id="alterar_mensagem" class='btn btn-success'>Salvar</button>
			<a href="?pagina=gerenciar_mensagens.php" class="btn btn-default">Cancelar</a>
		</div>
		<div class="pull-left">
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_apagar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar</button>
		</div>
	</form><?php
}
?>