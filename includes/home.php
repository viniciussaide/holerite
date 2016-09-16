<?php
include 'verifica_senha.php';
$matricula = $_SESSION['user_name'];
$data_atual = date('Y-m-d');
$query = "SELECT * FROM mensagem JOIN relacao_mensagem_user ON id_mensagem=fk_id_mensagem WHERE fk_matricula='$matricula' AND DATEDIFF('$data_atual',data_inicio)>=0 AND DATEDIFF('$data_atual',data_fim)<=0 AND data_visualizacao IS NULL";
$result = mysqli_query($conn, $query);
$quant_mensagens_nova = mysqli_num_rows($result);
$query = "SELECT * FROM mensagem JOIN relacao_mensagem_user ON id_mensagem=fk_id_mensagem WHERE fk_matricula='$matricula' AND DATEDIFF('$data_atual',data_inicio)>=0 AND DATEDIFF('$data_atual',data_fim)<=0 ORDER BY id_mensagem DESC, data_fim ASC";
$result = mysqli_query($conn, $query);
$quant_mensagens = mysqli_num_rows($result);
if ($result){
	if ($quant_mensagens>=1){?>
		<div class="col-md-4">
			<h4>
			<b> Avisos Importantes</b></h4>
			<div class="panel-group" id="accordion">
			<?php
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
				$id_mensagem = $row['id_mensagem'];
				$titulo = $row['titulo'];
				$mensagem = $row['mensagem'];
				$data_visualizacao =  $row['data_visualizacao'];
				$data_inicio =  $row['data_inicio'];
				$data_fim =  strtotime($row['data_fim']);
				if ($data_visualizacao==''){
					$conn_root = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
					$bd = mysqli_select_db($conn_root, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
					mysqli_set_charset($conn_root, "utf8");
					$query = "UPDATE relacao_mensagem_user SET data_visualizacao='$data_atual' WHERE fk_id_mensagem=$id_mensagem AND fk_matricula=$matricula";
					mysqli_query($conn_root, $query);
					mysqli_close($conn_root);
					?>
					  <div class="panel panel-info">
						<div class="panel-heading">
						  <h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $id_mensagem;?>" aria-expanded="true" aria-controls="<?php echo $id_mensagem;?>">
							  <span class="glyphicon glyphicon-exclamation-sign" style="color:#d9534f"></span>
							  <b> <?php echo $titulo;?></b>
							  <i class="indicator glyphicon glyphicon-chevron-down pull-right"></i>
							</a>
						  </h4>
						</div>
						<div id="<?php echo $id_mensagem;?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						  <div class="panel-body" align="justify"><?php echo $mensagem;?><h6 align="right" style="margin-bottom:0px;"><small style="color: red;"><b>Expira em: <?php echo date('d/m/Y', $data_fim);?></b></small></h6></div>
						</div>
					  </div><?php
				}
				else {?>
				  <div class="panel panel-info">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $id_mensagem;?>" aria-expanded="false" aria-controls="<?php echo $id_mensagem;?>">
						  <b><?php echo $titulo;?></b>
						  <i class="indicator glyphicon glyphicon-chevron-right pull-right"></i>
						</a>
					  </h4>
					</div>
					<div id="<?php echo $id_mensagem;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					  <div class="panel-body" align="justify"><?php echo $mensagem;?><h6 align="right" style="margin-bottom:0px;"><small style="color: red;"><b>Expira em: <?php echo date('d/m/Y', $data_fim);?></b></small></h6></div>
					</div>
				  </div><?php
				}
			}
			?>
			</div>
		</div>
		<div class="col-md-8">
			<div class="well">
				<p style="font-size:16px;"><b>Seja bem vindo!</b></p><br>
				<p align='justify'>
				Este é o mais novo portal com informações relevantes para facilitar a comunicação entre a empresa
				<b><i>Sankyu S/A</i></b> e seus colaboradores. O intuito principal, é a disponibilização dos holerites (contra-cheques) dos últimos 6 meses.
				Ou seja, todo colaborador poderá acessar e imprimir o seu contra-cheque de qualquer lugar, no trabalho, de casa, pelo seu smartphone, 
				lanhouse ou qualquer outro dispositivo que esteja conectado a internet. 
				Com isso, estamos economizando com tempo e estamos também diminuindo a burocracia com a divulgação de certas informações. 
				Esse é mais um avanço da <b><i>Sankyu S/A</i></b> e de certo que será um grande ganho para o colaborador. </br></br>
				Contamos com a colaboração de todos.</br></br>
				<p align="right" style="font-family:Cambria; font-size:18px; line-height:1px;">Carlos Ito</p>
				<p align="right">Diretor Executivo</p></br>
				<p align='justify'>Qualquer dúvida, crítica ou sugestões referentes a este novo canal de comunicação, favor entrar em contato <a href="?pagina=contato.php">clicando aqui.</a> Teremos o prazer em solucionar qualquer questão.
				</p>
			</div>
		</div>
		<?php
	}
	else {?>
		<div class="well">
			<p style="font-size:16px;"><b>Seja bem vindo!</b></p><br>
			<p align='justify'>
			Este é o mais novo portal com informações relevantes para facilitar a comunicação entre a empresa
			<b><i>Sankyu S/A</i></b> e seus colaboradores. O intuito principal, é a disponibilização dos holerites (contra-cheques) dos últimos 6 meses.
			Ou seja, todo colaborador poderá acessar e imprimir o seu contra-cheque de qualquer lugar, no trabalho, de casa, pelo seu smartphone, 
			lanhouse ou qualquer outro dispositivo que esteja conectado a internet. 
			Com isso, estamos economizando com tempo e estamos também diminuindo a burocracia com a divulgação de certas informações. 
			Esse é mais um avanço da <b><i>Sankyu S/A</i></b> e de certo que será um grande ganho para o colaborador. </br></br>
			Contamos com a colaboração de todos.</br></br>
			<p align="right" style="font-family:Cambria; font-size:18px; line-height:1px;">Carlos Ito</p>
			<p align="right">Diretor Executivo</p></br>
			<p align='justify'>Qualquer dúvida, crítica ou sugestões referentes a este novo canal de comunicação, favor entrar em contato <a href="?pagina=contato.php">clicando aqui.</a> Teremos o prazer em solucionar qualquer questão.
			</p>
		</div>
	</div>
	<?php
	}
}
else {
	echo "Problemas com banco";
}
?>