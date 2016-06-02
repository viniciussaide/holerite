<?php
include 'verifica_senha.php';
?>
<script type="text/javascript">
function contador() {
	var digitado = document.getElementById('mensagem');
	var texto = document.getElementById('texto_contador');
		texto.innerHTML = "Limite de caracteres: " + (500 - digitado.value.length);
}
</script>

	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading" style='text-align:center;'>
			<h3 class="panel-title"><strong>Dúvidas, conselhos, problemas e elogios...</br>Deixe sua mensagem aqui!</strong></h3>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" action="?pagina=email.php" method="POST" id="formulario">
				<p><div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-tag"></i></span>
					<input type="text" class="form-control" name="assunto" placeholder="Assunto" required maxlength="60">                                        
				</div></p>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					<textarea onKeyUp="contador()" class="form-control" id="mensagem" name="mensagem" placeholder="Digite sua mensagem aqui..." required rows="10" style='resize: none;' maxlength="500"></textarea>					
				</div>
			</div>
			<div class="panel-footer clearfix">
				<div id="texto_contador" class="pull-left">Limite de caracteres: 500</div>
				<button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-send" ></i> Enviar</button>
			</div>
			</form>
			</div>
		</div>
	</div>