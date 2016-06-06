<!DOCTYPE html>
<html lang="en">
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
    <nav class="navbar navbar-default navbar-fixed-top hidden-print" style="box-shadow: 0 0 3px 1px #333;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <a class="navbar-brand" href="index.php"><img class="img-responsive" src="imgs/holeriteNome.png" width="150" style="padding-top:5px;"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
			<?php include "views/sessao.php"; ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <?php echo "<b>$_SESSION[primeiro_nome]"." "."$_SESSION[ultimo_nome]"; ?>, você está logado</b>
			  <span class="caret"></span></a>
				<ul class="dropdown-menu dropdown-menu-right">
                <li><a href="?pagina=troca_senha.php"><b>Alterar Senha</b></a></li>
                <li><a href=index.php?logout><b>Logout</b></a></li>
				</ul>
            </li>		
			</ul>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron hidden-xs hidden-print">
		<img class="img-responsive navbar-default" src="imgs/holerite.png" width="80%">
    </div>
	
    <div class="container" style="padding-top:15px;">
		<?php include "pagina.php";?>
	</div>
	<!-- /container -->
	
<?php include "includes/footer.php"; ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
	<?php if (isset($troca_senha)){
		echo "<script>$('#troca_senha').modal('show');</script>";
	}?>
	<script src="js/support.js"></script>
	<script src="js/checkbox_table.js"></script>
	<script>
	$(document).ready(function() {
		$('.navbar-nav a[href="'+location.search+'"]').parents('li').addClass('active');
	});
	</script>
  </body>
</html>