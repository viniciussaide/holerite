<?php

//Ordenação por coluna
if (isset($_POST['order'])){
	$_SESSION['order'] = $_POST['order'];
	if ($_SESSION['order']=='Desc_mat'){
		$order = 'ORDER BY matricula DESC';
	}
	elseif ($_SESSION['order']=='Asc_mat'){
		$order = 'ORDER BY matricula ASC';
	}
	elseif ($_SESSION['order']=='Desc_nome'){
		$order = 'ORDER BY nome DESC';
	}
	elseif ($_SESSION['order']=='Asc_nome'){
		$order = 'ORDER BY nome ASC';
	}
	elseif ($_SESSION['order']=='Asc_data'){
		$order = 'ORDER BY dataCadastro ASC';
	}
	elseif ($_SESSION['order']=='Desc_data'){
		$order = 'ORDER BY dataCadastro DESC';
	}
	else {
		$order = 'ORDER BY matricula ASC';
	}
}
else {
	if (!isset($_SESSION['order'])){
		$_SESSION['order'] = 'Asc_mat';
	}
	if ($_SESSION['order']=='Desc_mat'){
		$order = 'ORDER BY matricula DESC';
	}
	elseif ($_SESSION['order']=='Asc_mat'){
		$order = 'ORDER BY matricula ASC';
	}
	elseif ($_SESSION['order']=='Desc_nome'){
		$order = 'ORDER BY nome DESC';
	}
	elseif ($_SESSION['order']=='Asc_nome'){
		$order = 'ORDER BY nome ASC';
	}
	elseif ($_SESSION['order']=='Asc_data'){
		$order = 'ORDER BY dataCadastro ASC';
	}
	elseif ($_SESSION['order']=='Desc_data'){
		$order = 'ORDER BY dataCadastro DESC';
	}
	else {
		$order = 'ORDER BY matricula ASC';
	}
}
//Fim ordenação por coluna


//Seleção quantidade de itens a mostrar
if (isset($_POST['numitems'])){
	$numitems = $_POST['numitems'];
	$_SESSION['numitems'] = $_POST['numitems'];
	$_SESSION['pagina'] = 1;
}
else {
	if (!isset($_SESSION['numitems'])){
		$numitems = 30;
	}
	else {
		$numitems = $_SESSION['numitems'];
	}
}
//Fim Seleção quantidade de itens a mostrar


if (isset($_POST['busca'])){
	$_SESSION['pagina'] = 1;
}

if (isset($_POST['nump'])){
	$_SESSION['pagina'] = $_POST['nump'];
}
if (isset($_SESSION['pagina'])){
	$inicio = $numitems*($_SESSION['pagina']-1);
	$fim = ($numitems*$_SESSION['pagina'])-1;
}
else {
	$_SESSION['pagina'] = 1;
	$inicio = 0;
	$fim = 29;
}




$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("erro ao conectar");
$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");

if (isset($_POST['txt_busca'])){
	$_SESSION['txt_busca'] = $_POST['txt_busca'];
	$query = "SELECT count(*) FROM users WHERE nome LIKE '%".$_POST['txt_busca']."%' OR matricula LIKE '%".$_POST['txt_busca']."%';";
}
elseif (isset($_SESSION['txt_busca'])){
	$query = "SELECT count(*) FROM users WHERE nome LIKE '%".$_SESSION['txt_busca']."%' OR matricula LIKE '%".$_SESSION['txt_busca']."%';";
}
else {
	$query = "SELECT count(*) FROM users;";
}

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result,  MYSQL_NUM);
if (!isset($paginas)){
	$paginas = ceil($row[0]/$numitems);
}
?>


<form method=POST action="?pagina=relatorio.php">
<?php include "includes/paginacao.php";?>
	<div class="well clearfix">
		<div class="row">
		  <div class="col-xs-4">
			  <div class="input-group">
			  <?php
				if (isset($_SESSION['txt_busca'])){
					echo "<input type='text' name='txt_busca' class='form-control' placeholder='Nome ou matrícula' value=".$_SESSION['txt_busca']."></input>";
				}
				else {
					echo "<input type='text' name='txt_busca' class='form-control' placeholder='Nome ou matrícula'></input>";
				}
			  ?>
			  
			  <span class="input-group-btn">
				<button class="btn btn-default" type="submit" name='busca'><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
			  </span>
			</div>

		  </div>
		  <div class="col-xs-8">
			<div class="input-group pull-right">
				<button class="btn btn-info" type="submit" name='relatorio'>Gerar Relatório</button>
			</div>
		  </div>
		</div>
		</p>
		<table class="table table-hover" style="background-color: #FFFFFF;border-radius: 10px;">
			<thead align=center>
			<td>
				<input class="btn btn-link" type='checkbox' id='select_all'>
			</td>
			<td>
				<?php
				if (!isset($_SESSION['order'])){
					echo "<button class='btn btn-link form-control' type='submit' value='Desc_mat' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Matrícula</b></button>";
				}
				else {
					if ($_SESSION['order']=='Desc_mat'){
						echo "<button class='btn btn-link form-control' type='submit' value='Asc_mat' name='order'><b><span class='glyphicon glyphicon-menu-up' aria-hidden='true'></span> Matrícula</b></button>";
					}
					else {
						echo "<button class='btn btn-link form-control' type='submit' value='Desc_mat' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Matrícula</b></button>";
					}
				}
				?>
			</td>
			<td>
				<?php
				if (!isset($_SESSION['order'])){
					echo "<button class='btn btn-link form-control' type='submit' value='Desc_nome' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Nome</b></button>";
				}
				else {
					if ($_SESSION['order']=='Desc_nome'){
						echo "<button class='btn btn-link form-control' type='submit' value='Asc_nome' name='order'><b><span class='glyphicon glyphicon-menu-up' aria-hidden='true'></span> Nome</b></button>";
					}
					else {
						echo "<button class='btn btn-link form-control' type='submit' value='Desc_nome' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Nome</b></button>";
					}
				}
				?>
			</td>
			<td>
				<?php
				if (!isset($_SESSION['order'])){
					echo "<button class='btn btn-link form-control' type='submit' value='Desc_data' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Data de Cadastro</b></button>";
				}
				else {
					if ($_SESSION['order']=='Desc_data'){
						echo "<button class='btn btn-link form-control' type='submit' value='Asc_data' name='order'><b><span class='glyphicon glyphicon-menu-up' aria-hidden='true'></span> Data de Cadastro</b></button>";
					}
					else {
						echo "<button class='btn btn-link form-control' type='submit' value='Desc_data' name='order'><b><span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span> Data de Cadastro</b></button>";
					}
				}
				?>
			</td></thead>
		</table>
		<table id='lista_usuario' class="table table-hover" style="background-color: #FFFFFF;border-radius: 10px;">
			<?php
			if (isset($_POST['txt_busca'])){
				$query = "SELECT matricula, nome, dataCadastro FROM users WHERE nome LIKE '%".$_SESSION['txt_busca']."%' OR matricula LIKE '%".$_SESSION['txt_busca']."%' $order LIMIT $inicio, $fim";
			}
			elseif (isset($_SESSION['txt_busca'])){
				$query = "SELECT  matricula, nome, dataCadastro FROM users WHERE nome LIKE '%".$_SESSION['txt_busca']."%' OR matricula LIKE '%".$_SESSION['txt_busca']."%' $order LIMIT $inicio, $fim";
			}
			else {
				$query = "SELECT matricula, nome, dataCadastro FROM users $order LIMIT $inicio, $fim";
			}
			$result = mysqli_query($conn, $query);
			while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
				$matricula = $row["matricula"];
				$nome = $row["nome"];
				$dataCadastro = date_format(new DateTime($row["dataCadastro"]),'d/m/Y');
				//echo "<tr><td align=center><input type='checkbox' value='$matricula'></td><td>$matricula - $nome</td></tr>";
				echo "<tr align=center><td><input name='matriculas[]' type='checkbox' value=$matricula></td><td>$matricula</td><td>$nome</td><td>$dataCadastro</td></tr>";
			}
			?>
		</table>
			<div class="input-group pull-right">
				<button class="btn btn-info" type="submit" name='relatorio'>Gerar Relatório</button>
			</div>
	</div>
<?php include "includes/paginacao.php"; ?>
</form>


