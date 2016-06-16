<?php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ){
	$tipo_menu = $_SESSION['posts']['tipo_menu'];
	$id_funcao_atual = $_SESSION['posts']['id_funcao'];
	$nome_menu_atual = $_SESSION['posts']['nome_menu'];
?>
	<select class="form-control" name="prioridades[]" id="prioridades" size='11' multiple>
<?php
		if (($tipo_menu=="Lateral Simples")OR($tipo_menu=="Lateral Dropdown")){
			$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%lateral%' ORDER BY prioridade";
		}
		elseif (($tipo_menu=="Superior Simples")OR($tipo_menu=="Superior Dropdown")){
			$query = "SELECT * FROM funcao WHERE tipo_menu LIKE '%superior%' ORDER BY prioridade";
		}
		else {
			$query = "SELECT * FROM funcao WHERE tipo_menu='$tipo_menu' ORDER BY prioridade";
		}
		$result = mysqli_query($conn, $query);
		if ($result){
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
				$id_funcao_lista = $row['id_funcao'];
				$nome_menu = $row['nome_menu'];
				echo "<option value='$id_funcao_lista'>$nome_menu</option>";
			}
			echo "<option value='$id_funcao_atual' selected='selected'>$nome_menu_atual</option>";
		}
	}
?>
</select>