<!DOCTYPE html>
<?php require_once("../config/db.php"); 
require_once("../includes/contador_principal.php");?>

<html lang="pt-br">
  <head class="hidden-print">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="../imgs/iconelogo.ico">

    <title>Administrador Holerite Online Sankyu</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/jumbotron.css" rel="stylesheet">
	<link href="../css/sticky-footer.css" rel="stylesheet">

    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-default navbar-fixed-top"  style="box-shadow: 0 0 3px 1px #333;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
			<a class="navbar-brand" href="index.php"><img class="img-responsive" src="../imgs/holeriteNome.png" width="150" style="padding-top:5px;"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
		<div id="navbar" class="navbar-collapse collapse in" aria-expanded="true">
          <ul class="nav navbar-nav">
            <li><a href="home_adm.php"><b>Home Administrador</b></a></li>
            <li class="active"><a href="upHolerite.php"><b>Upload de Holerite</b></a></li> 
          </ul>
        </div>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="hidden-xs hidden-print navbar-default clearfix">
		<img class="pull-right" src="../imgs/holerite.png" width="80%">
	</div>
    <div class="container">
      <!-- Example row of columns -->
		<div id="upload">
		<form id='upload_holerite' action='uploadHolerite.php' method='POST'>
			<?php
/* 			$files = scandir('../arquivos/holerite/');
			foreach($files as $file) {
				if (($file<>'.')&&($file<>'..')){
					echo "<input type='hidden' name='arquivo_holerite[]' value='$file' required>";
				}
			}
			$files = scandir('../arquivos/efetivo/');
			foreach($files as $file) {
				if (($file<>'.')&&($file<>'..')){
					echo "<input type='hidden' name='arquivo_efetivo[]' value='$file' required>";
				}
			} */
			include "uploadHolerite.php";
			?>
		</form>
		</div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
	<!--<script src="../js/upload_holerite.js"></script>-->
  </body>
</html>