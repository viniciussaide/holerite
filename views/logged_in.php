<?php
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("Erro ao conectar");
$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
mysqli_set_charset($conn, "utf8");
if(isset($_GET["pagina"])){
	$pagina = $_GET["pagina"];
}
else {
	$pagina = "home.php";
}

if ($_SERVER['REQUEST_METHOD']=="POST"){
	$_SESSION['posts'] = $_POST;
	parse_str($_SERVER['QUERY_STRING']);
	$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao WHERE (".$_SESSION['query_restricao'].") AND pagina_php='$pagina'";
	$result = mysqli_query($conn, $query);
	if ($result){
		if (mysqli_num_rows($result)>=1){
			header('HTTP/1.1 303 See Other');
			header ("Location:?pagina=$pagina");
		}
		else {
			echo "Sem permissão!";
		}
	}
}
else{
?>
	<!DOCTYPE html>
	<html lang="pt-br">
	  <head class=hidden-print>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<link rel="icon" href="imgs/iconelogo.ico">

		<title>Holerite Online Sankyu</title>

		<!--CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/jumbotron.min.css" rel="stylesheet">
		<link href="css/sticky-footer.min.css" rel="stylesheet">
		
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<script src="assets/js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	  </head>
	  <body>
		<?php include "views/menu_superior.php"; ?>
		<div class="hidden-xs hidden-print navbar-default clearfix">
			<img class="pull-right" src="imgs/holerite.png" width="80%">
		</div>
		<div class="container-fluid">
		<?php include "views/restricao_menu_lateral.php"; ?>
		</div>	
		<!-- /container -->
		<?php include "views/footer.php"; ?>


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
		<script src="dist/js/bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
		<?php if (isset($troca_senha)){
			echo "<script>$('#troca_senha').modal('show');</script>";
		}?>
		<script src="js/support.js"></script>
		<script src="js/checkbox_table.js"></script>
		<script>
		//Muda class do menu atual para ativo
		$(document).ready(function() {
			$('.navbar-nav a[href="'+location.search+'"]').parents('li').addClass('active');
		});
		
		//Change glyphicon collapse right/down
		$('.collapse').on('shown.bs.collapse', function () {
			$(this).prev().find(".glyphicon").removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
		});
		//Change glyphicon collapse down/right
		$('.collapse').on('hidden.bs.collapse', function () {
			$(this).prev().find(".glyphicon").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
		});
		//Selecionar todos itens da lista prioridade
		$('#alterar_funcao').click(function() {
			$('#prioridades option').prop('selected', true);
		});
		
		//Mover para cima ou para baixo para prioridade
		$(document).ready(function() {
			$('#move-up').click(moveUp);
			$('#move-down').click(moveDown);
		});

		function moveUp() {
			$('#prioridades :selected').each(function(i, selected) {
				if (!$(this).prev().length) return false;
				$(this).insertBefore($(this).prev());
			});
			$('#prioridades').focus().blur();
		}

		function moveDown() {
			$($('#prioridades :selected').get().reverse()).each(function(i, selected) {
				if (!$(this).next().length) return false;
				$(this).insertAfter($(this).next());
			});
			$('#prioridades').focus().blur();
		}
		</script>
	  </body>
	</html><?php
}
?>