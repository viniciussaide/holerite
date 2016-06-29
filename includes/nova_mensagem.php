<form action="?pagina=gerenciar_mensagens.php" method="POST">
	<input type="hidden" name="id_mensagem" value=""></input>
	<div class="col-md-4">
		<div class="well">
			<div class="form-group">
				<label>Título</label>
				<input type="text" class="form-control" name="titulo" placeholder="Título"></input>
			</div>
			<div class="form-group">
				<label>Descrição</label>
				<textarea class="form-control" name="descricao" placeholder="Descrição" rows="3" maxlength="300" style="resize: none;"></textarea>
			</div>
			<div class="form-group">
				<label>Mensagem</label>
				<textarea class="form-control" name="mensagem" placeholder="Mensagem" rows="5" maxlength="2500" style="resize: none;"></textarea>
			</div>
			<div class="form-group">
				<label>Data Início: </label><input class="form-control" type="text" name="data_inicio" id="data_inicio" value="">
			</div>
			<div class="form-group">
				<label>Data Fim: </label><input class="form-control" type="text" name="data_fim" id="data_fim" value="">
			</div>
				<label><input type='checkbox' name='tela_inicial'> Mensagem na Tela Inicial</label>
		</div>
	</div>
	<div class="well col-md-8">
		<div>
			<label>Permissão para Editar Mensagem</label>
				<?php
				$query = "SELECT * FROM user_type LEFT JOIN relacao_type_mensagem ON fk_id_user_type=id_user_type AND (".$_SESSION['query_restricao'].") GROUP BY id_user_type";
				$result = mysqli_query($conn, $query);
				while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
					$type = $row['type'];
					$id_user_type = $row['id_user_type'];
					if($row['id_user_type']<>'2') {
						echo "<div class='checkbox'><label><input type='checkbox' name='permissao[]' value='$id_user_type' checked> $type</label></div>";
					}
				}
				?>
			<p align="center"><label>Usuários</label></p>
			<div class="col-md-6 form-group">
				<label>Mostrar Mensagem para:</label>
				<select multiple id="select1" size='20' class="form-control" name="permissao_usuarios[]">
				</select>
			</div>
			<div class="col-md-6 form-group">
				<label>Não Mostrar Mensagem para:</label>
				<select multiple id="select2" size='20' class="form-control">
					<?php
					$query = "SELECT * FROM users ORDER BY matricula";
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
		<button name='salvar_nova_mensagem' id="salvar_nova_mensagem" class='btn btn-success'>Salvar</button>
		<a href="?pagina=gerenciar_mensagens.php" class="btn btn-default">Cancelar</a>
	</div>                
</form>