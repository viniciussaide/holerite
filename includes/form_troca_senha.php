<?php 
	$cpf = $_SESSION['cpf'];
	$cpf_mask = substr($cpf,0,3).".".substr($cpf,3,3).".".substr($cpf,6,3)."-".substr($cpf,9,2);
?>
<script type="text/javascript" src="js/verifica_senha_iguais.js"></script>
<div class="row">
	<div class="col-md-8">
		<form action="?pagina=troca_senha.php" method="POST" class="form-horizontal">
			<div class="panel panel-info">
				<div class="panel-heading" style='text-align:center;'>
					<h3 class="panel-title"><strong>Colaborador: <?php echo $_SESSION['nome']?></strong></h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-2" align="right">Matrícula:</label>
						<div class="col-sm-10">
							<?php echo $_SESSION['user_name'];?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2" align="right">CPF:</label>
						<div class="col-sm-10">
							<?php echo $cpf_mask;?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2" align="right">Cargo:</label>
						<div class="col-sm-10">
							<?php 
							if ($_SESSION['cargo']<>'') {
								echo $_SESSION['cargo'];
							}
							else {
								echo "Falta informação";
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" align="right">Email:</label>
						<div class="col-sm-4">
							<input type="text" name="email" class="form-control" value="<?php if ($_SESSION['email']<>'') {echo $_SESSION['email'];}?>" placeholder="exemplo@sankyu.com.br" required>
							</input> 
						</div>
					</div>
				</div>
				<div class="panel-footer clearfix">
					<div class="form-inline pull-right">
						<button type="submit" name="alterar_email" class="btn btn-primary">
							Salvar alterações
						</button>
					</div>
				</div>	
			</div>
		</form>
	</div>
	<div class="col-md-4">
		<form action="?pagina=troca_senha.php" method="POST">
			<div class="panel panel-success">
				<div class="panel-heading">
				<h3 class="panel-title"><strong>Alterar Senha</strong></h3>
				</div>
				<div class="panel-body">
					<div class="input-group"  style="padding-bottom: 5px;"> <span class="input-group-addon" id="basic-addon1">Senha Atual</span>
						<input type="password" class="form-control" tabindex="1" name="senha_atual" aria-describedby="basic-addon1" required autofocus placeholder="Digite sua senha atual">
					</div>
					<div class="input-group" style="padding-bottom: 5px;"> <span class="input-group-addon" id="basic-addon1">Nova Senha</span>
						<input type="password" id="pass1" name="senha_nova" class="form-control" tabindex="1" aria-describedby="basic-addon1" autocomplete="off" required placeholder="Digite uma nova senha">
					</div>
					<div class="input-group" style="padding-bottom: 5px;"> <span class="input-group-addon" id="basic-addon1">Nova Senha</span>
						<input type="password" id="pass2" name="senha_nova_2" class="form-control" tabindex="1" aria-describedby="basic-addon1" onKeyUp="checkPass()" autocomplete="off" required placeholder="Repita a senha nova">
					</div>	
				</div>
				<div class="panel-footer clearfix">
					<div class="alert alert-danger hidden pull-left" id="confirmMessage" role="alert" style="padding-top: 5px;padding-bottom: 5px;margin-bottom: 0px;"></div>
					<input type="submit" class="btn btn-success pull-right" id="btn" value="Trocar Senha" disabled="disabled">
				</div>
			</div>
		</form>
	</div>
</div>