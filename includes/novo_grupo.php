<?php
$id_user_type = '';
?>
<div class="container-fluid">
	<form action="?pagina=gerenciar_grupos.php" method="POST">
		<input type="hidden" value='' name="id_user_type" id="id_user_type">
		<div class="row">
			<div class="form-group col-xs-3">
				<label for="nome_grupo">Nome do Grupo: </label>
				<input type="text" class="form-control" name="nome_grupo" id="nome_grupo">
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
						echo "<div class='checkbox'><label><input type='checkbox' name='permissao_funcao[]' value='$id_funcao'> $nome_funcao</label></div>";
					}
					?>
				</div>
			</div>
			<div class="well col-md-8">
				<p align="center"><label>Usuários</label></p>
				<div class="col-md-6 form-group">
					<label>Pertencem ao Grupo</label>
					<select multiple id="select1" size='15' class="form-control" name="permissao_usuarios[]">
					</select>
				</div>
				<div class="col-md-6 form-group">
					<label>Não Pertencem ao Grupo</label>
					<select multiple id="select2" size='15' class="form-control">
						<?php
						$query = "SELECT * FROM users WHERE matricula ORDER BY matricula";
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
						echo "<div class='checkbox'><label><input type='checkbox' name='permissao_mensagem[]' value='$id_mensagem'> $descricao_mensagem</label></div>";
					}
					?>
				</div>
			</div>
		</div>
		<div class="pull-right">
			<button type="submit" class="btn btn-success" name="salvar_novo_grupo" id="salvar_novo_grupo">Salvar</button>
			<a href="?pagina=gerenciar_grupos.php" class="btn btn-default">Cancelar</a>
		</div>
	</form>
</div>