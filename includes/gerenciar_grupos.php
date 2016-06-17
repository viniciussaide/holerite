<?php
if (isset($_SESSION['posts']['user_type'])){
	$id_user_type = $_SESSION['posts']['user_type'];
	$query = "SELECT * FROM user_type WHERE id_user_type='$id_user_type'";
	$result = mysqli_query($conn, $query);
	if ($result){
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		$nome_grupo = $row['type'];
?>
	<div class="container-fluid">
		<form action="?pagina=gerenciar_grupos.php" method="POST">
			<!--Modal apagar Grupo-->
			<div class="modal fade" id="modal_apagar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog " role="document" style="width:300px;margin-top:-150px;margin-left:-150px;">
				<div class="modal-content panel panel-danger">
				  <div class="modal-header panel-heading">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel" align="center"><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Apagar Função</strong></h4>
				  </div>
				  <div class="modal-body panel-body">
					<div align="center">
					<p>Quer realmente apagar a função?</p>
					<button type="submit" class="btn btn-danger" name="apagar_funcao"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Apagar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				  </div>
				</div>
			  </div>
			</div>
			<!--Fim Modal apagar Grupo-->
			<input type="hidden" value='<?php echo $id_user_type;?>' name="id_user_type" id="id_user_type">
			<div class="row">
				<div class="form-group col-xs-3">
					<label for="nome_grupo">Nome do Grupo: </label>
					<input type="text" class="form-control" name="nome_grupo" id="nome_grupo" value="<?php echo $nome_grupo;?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="well form-group">
						<label>Permissões Funções</label>
						<?php
						$query = "SELECT * FROM funcao LEFT JOIN relacao_type_funcao ON fk_id_funcao=id_funcao AND fk_id_user_type='$id_user_type'";
						$result_2 = mysqli_query($conn, $query);
						while($row = mysqli_fetch_array($result_2, MYSQL_ASSOC)){
							$id_funcao = $row['id_funcao'];
							$nome_funcao = $row['funcao'];
							if ($id_user_type==$row['fk_id_user_type']){
								echo "<div class='checkbox'><label><input type='checkbox' name='permissao[]' value='$id_funcao' checked> $nome_funcao</label></div>";
							}
							else {
								echo "<div class='checkbox'><label><input type='checkbox' name='permissao[]' value='$id_funcao'> $nome_funcao</label></div>";
							}
						}
						?>
					</div>
				</div>
				<div class="col-md-4">
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-4">
				</div>
			<?php
			$query = "SELECT * FROM relacao_type_user JOIN users ON matricula=fk_matricula WHERE fk_id_user_type='$id_user_type'";
			$result_2 = mysqli_query($conn, $query);
			Kint::dump( $result_2 );
			$query = "SELECT * FROM relacao_type_user RIGHT JOIN users ON matricula=fk_matricula WHERE fk_id_user_type IS NULL";
			$result_2 = mysqli_query($conn, $query);
			Kint::dump( $result_2 );
			?>
			</div>
		</form>
	</div>
		<?php
	}
}
elseif(isset($_POST['novo_user_type'])){

}
else {
	include "includes/lista_grupos.php";
}
unset($_SESSION['posts']);
?>




<div>
    <select multiple id="select1">
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
        <option value="4">Option 4</option>
    </select>
</div>
<div>
    <select multiple id="select2"></select>
</div>
jquery

$('#select1').click(function () {
     return !$('#select1 option:selected').remove().appendTo('#select2');
});

$('#select2').click(function () {
     return !$('#select2 option:selected').remove().appendTo('#select1');
 });