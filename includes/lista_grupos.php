<form action="?pagina=gerenciar_grupos.php" method="POST">
	<div class='well'>
			<div class="input-group pull-right">
				<button class="btn btn-primary" type="submit" name="novo_grupo"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Novo Grupo</button></p>
			</div>
			<table class="table table-hover" style="background-color: #FFFFFF;border-radius: 10px;">
				<thead>
					<td class="col-md-4"><button class="btn btn-link" type="submit" value="Desc_nome_grupo" name="order"><b><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> Nome do Grupo</b></button></td>
					<td class="col-md-4"><button class="btn btn-link" type="submit" value="Desc_funcoes" name="order"><b><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> Funções Liberadas</b></button></td>
					<td class="col-md-4"><button class="btn btn-link" type="submit" value="Desc_quantidade" name="order"><b><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span> Quantidade de Usuários</b></button></td>
				</thead>
			</table>
		<div class='list-group'>
		<?php
			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("Erro ao conectar");
			$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
			mysqli_set_charset($conn, "utf8");
			$query = "SELECT * FROM user_type";
			$result = mysqli_query($conn, $query);
			if ($result){
				while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					$id_user_type = $row['id_user_type'];
					$type = $row['type'];
					$query = "SELECT * FROM relacao_type_funcao JOIN funcao ON fk_id_funcao=id_funcao WHERE fk_id_user_type='$id_user_type'";
					$result_2 = mysqli_query($conn, $query);
			//Kint::dump( $result_2 );
					$funcoes = '';
					if ($result_2){
						while($row_2 = mysqli_fetch_array($result_2, MYSQL_ASSOC)) {
							$funcoes .= $row_2['funcao']."<br>";
						}
					}
					$query = "SELECT COUNT(*) FROM relacao_type_user WHERE fk_id_user_type='$id_user_type'";
					$result_2 = mysqli_query($conn, $query);
					$row_2 = mysqli_fetch_array($result_2, MYSQL_NUM);
					$quantidade_users = $row_2[0];
					echo "<button type='submit' class='list-group-item' value='$id_user_type' name='user_type'><div class='col-xs-4'>$type</div><div class='col-xs-4'>$funcoes</div><div class='col-xs-4'><span class='badge'>$quantidade_users</span></div></button>";
				}
			}
		?>
		</div>
	</div>
</form>