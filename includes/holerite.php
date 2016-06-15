
<?php
include 'verifica_senha.php';

if(isset($_SESSION['posts']['data'])){
	include 'selectHolerite.php';
}
else {
?>
	<div class="row">
        <div class="col-md-3">
		</div>
        <div class="col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading">
				<h3 class="panel-title"><strong>Selecione a holerite do período desejado:</strong></h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="?pagina=holerite.php" method="POST">
					<div style='text-align:center;'>
						<?php
						include 'selectAno.php'
						?>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } ?>