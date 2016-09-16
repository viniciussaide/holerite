<form method="POST" action="?pagina=gerenciar_mensagens.php">
	<!--MENSAGENS-->
	<div class="well">
		<div class="pull-right input-group">
			<button name="nova_mensagem" class='btn btn-primary'><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nova Mensagem</button>
			<p></p>
		</div>
		<table class="table" style="background-color: #FFFFFF;border-radius: 10px;">
			<thead align="center">
				<td class="col-xs-4">
					<button class='btn btn-link form-control' type='submit' value='Desc_mat' name='order' style="text-align:left">
						<b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Título</b>
					</button>
				</td>
				<td class="col-xs-8">
					<button class='btn btn-link form-control' type='submit' value='Desc_nome' name='order' style="text-align:left">
						<b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Descrição</b>
					</button>
				</td>
			</thead>
		</table>  
		<!--INICIO DAS MENSAGENS-->
		<div class="list-group">
			<?php
				$query = "SELECT * FROM mensagem JOIN relacao_type_mensagem ON id_mensagem=fk_id_mensagem WHERE ".$_SESSION['query_restricao']." GROUP BY id_mensagem;";
				$result = mysqli_query($conn, $query);
				if ($result){
					while ($row = mysqli_fetch_array($result,  MYSQL_ASSOC)){
						$id_mensagem = $row['id_mensagem'];
						$titulo = $row['titulo'];
						$descricao = $row['descricao'];
						?>
						<button type="submit" name="seleciona_mensagem" class="list-group-item" value="<?php echo $id_mensagem;?>">
							
							<div class="col-xs-4">
								<p align="justify"><?php echo $titulo;?></p>
							</div>
							<div class="col-xs-8">
								<p align="justify">
								<?php echo $descricao;?>
								</p>
							
							</div>
						</button>
						<?php
					}
				}
			?>
		</div>
	</div>
</form>