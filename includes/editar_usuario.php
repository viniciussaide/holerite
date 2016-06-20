<?php
$matricula = $_SESSION['posts']['seleciona_usuario'];
$query = "SELECT * FROM users JOIN setor ON id_setor=fk_id_setor WHERE matricula=$matricula";
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
		<button type="submit" class="btn btn-danger" name="reset_senha">Resetar Senha</button>
		<button type="submit" class="btn btn-warning" name="gerar_nova_chave">Gerar Nova Chave de Segurança</button>
	</div>
</form>
<?php
}
?>