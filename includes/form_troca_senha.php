<script type="text/javascript" src="js/verifica_senha_iguais.js"></script>
<div class="row">
	<div class="col-md-4 col-sm-3">
	</div>
	<div class="col-md-5 col-sm-6">
		<div class="panel panel-success">
			<div class="panel-heading">
			<h3 class="panel-title"><strong>Preencha os campos:</strong></h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" action="?pagina=troca_senha.php" method="POST">
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
			</form>
		</div>
	</div>
	<div class="col-md-3 col-sm-3">
	</div>
	</div>
</div>