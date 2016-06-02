<!DOCTYPE html>
<?php require_once("includes/contador_principal.php");?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="imgs/iconelogo.ico">

    <title>Holerite Online Sankyu</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/holerite/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">
	<link href="css/sticky-footer.css" rel="stylesheet">

    <script src="/holerite/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <nav class="navbar navbar-default navbar-fixed-top" style="box-shadow: 0 0 3px 1px #333;">
      <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand" href="index.php"><img class="img-responsive" src="imgs/holeriteNome.png" width="200" style="padding-top:5px;"></a></a>
        </div>
		<!--/.navbar-collapse -->
      </div>
    </nav>
	
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
		<img class="img-responsive navbar-default" src="/holerite/imgs/holerite.png" width="80%">
    </div>
	
    <div id="corpo" class="container" style="padding-top:15px;">
		<div class="row">
			<div class="col-md-3">
			</div>
			<div class="col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
					<h3 class="panel-title" align=center><strong>Preencha o formulário abaixo com todos os campos solicitados.</br>
					Não deixe nada em branco.</strong></h3>
					</div>
					<form class="form-horizontal" method="post">
					<div class="panel-body">
						<input type="hidden" name="etapa" value="senha_1"></input>
						<div class="input-group" style="padding-bottom: 5px;">
						<span class="input-group-addon" id="basic-addon1">Matricula:</span>
							<input type="text" class="form-control" tabindex="1" name="matricula" aria-describedby="basic-addon1" required autofocus placeholder="Digite sua matrícula">
						</div>				
					</div>
					<div class="panel-footer clearfix">
							<a href="index.php" class="btn btn-primary pull-left" id="btn">Página Inicial</a>
							<input type="submit" name="senha_1" class="btn btn-success pull-right" value="Enviar"></button>
						
					</div>
					</form>
				</div>
			</div>
			<div class="col-md-3">
				<div class="alert alert-danger hidden" id="confirmMessage" role="alert">
				</div>
			</div>
		</div>
	</div>
<?php include "includes/footer.php"; ?>
	<!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/holerite/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/holerite/assets/js/ie10-viewport-bug-workaround.js"></script>
	<script src="js/recuperar_senha.js"></script>
  </body>
</html>