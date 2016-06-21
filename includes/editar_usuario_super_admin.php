<?php
$matricula = $_SESSION['posts']['seleciona_usuario'];
$query = "SELECT * FROM users LEFT JOIN setor ON id_setor=fk_id_setor WHERE matricula=$matricula";
$result = mysqli_query($conn, $query);
if($result){
	$row = mysqli_fetch_array($result,  MYSQL_ASSOC);
	$nome = $row['nome'];
	$setor = $row['setor'];
	$cpf = $row['cpf'];
	$cpf_mask = substr($cpf,0,3).".".substr($cpf,3,3).".".substr($cpf,6,3)."-".substr($cpf,9,2);
	$cargo = $row['cargo'];
	$email = $row['email'];
?>
<form method="POST" action="?pagina=gerenciar_usuarios.php">
	<input type="hidden" value='<?php echo $matricula;?>' name="matricula" id="matricula">
	<!--Modal resetar Senha-->
	<div class="modal fade" id="modal_reset_senha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog " role="document" style="width:300px;margin-top:-150px;margin-left:-150px;">
		<div class="modal-content panel panel-danger">
		  <div class="modal-header panel-heading">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel" align="center"><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Resetar Senha</strong></h4>
		  </div>
		  <div class="modal-body panel-body">
			<div align="center">
			<p>Quer realmente resetar a senha do colaborador? A senha voltará a ser os 11 dígitos do CPF!</p>
			<button type="submit" class="btn btn-danger" name="reset_senha"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Resetar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<!--Fim Modal resetar Senha-->
	<!--Modal gerar nova chave-->
	<div class="modal fade" id="modal_gerar_chave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog " role="document" style="width:300px;margin-top:-150px;margin-left:-150px;">
		<div class="modal-content panel panel-danger">
		  <div class="modal-header panel-heading">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel" align="center"><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Chave de Segurança</strong></h4>
		  </div>
		  <div class="modal-body panel-body">
			<div align="center">
			<p>Quer realmente gerar uma nova chave de segurança para o colaborador?</p>
			<button type="submit" class="btn btn-danger" name="gerar_nova_chave"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Gerar Nova Chave</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<!--Fim gerar nova chave-->
	<!--Modal apagar usuario-->
	<div class="modal fade" id="modal_apagar_usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog " role="document" style="width:300px;margin-top:-150px;margin-left:-150px;">
		<div class="modal-content panel panel-danger">
		  <div class="modal-header panel-heading">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel" align="center"><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Apagar Usuário</strong></h4>
		  </div>
		  <div class="modal-body panel-body">
			<div align="center">
			<p>Quer realmente apagar o usuário?</p>
			<button type="submit" class="btn btn-danger" name="apagar_usuario"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar Usuário</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<!--Fim apagar usuario-->
	<div class="panel panel-info">
		<div class="panel-heading" style='text-align:center;'>
			<h3 class="panel-title"><strong>Colaborador: <?php echo $nome;?></strong></h3>
		</div>
		<div class="panel-body">
			<div class="col-sm-6">
				<p class="row"><label class="col-xs-3" align="right">Matrícula:</label><?php echo $matricula;?></p>
				<p class="row"><label class="col-xs-3" align="right">CPF:</label><?php echo $cpf_mask;?></p>
			</div>
			<div class="col-sm-6">
				<p class="row"><label class="col-xs-3" align="right">Cargo:</label><?php echo $cargo;?></p>
				<p class="row"><label class="col-xs-3" align="right">Email:</label><?php echo $email;?></p>                                                                                                                                                  
			</div> 
		</div>
	</div>
	<div class="form-inline pull-right">
		<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_reset_senha">Resetar Senha</button>
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_gerar_chave">Gerar Nova Chave de Segurança</button>
	</div>
	<div class="pull-left">
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_apagar_usuario"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar Usuário</button>
	</div>
</form>
<?php
}
?>