<div class='row form-inline'>
	<ul class="pager col-xs-9">
		<?php 
			if ($_SESSION['pagina']>1){
				$anterior = $_SESSION['pagina']-1;
				echo "<button name='nump' class='btn btn-default pull-left' style='border-radius: 30px;' value=1>Primeira</button>";
				echo "<button name='nump' class='btn btn-default pull-left' style='border-radius: 30px;' value=$anterior><span aria-hidden='true'>&laquo;</span> Anterior</button>";
			}
			else {
				echo "<button name='nump' class='btn btn-default pull-left' style='border-radius: 30px;' disabled>Primeira</button>";
				echo "<button name='nump' class='btn btn-default pull-left' style='border-radius: 30px;' disabled><span aria-hidden='true'>&laquo;</span> Anterior</button>";
			}
			echo "Página ".$_SESSION['pagina']." de $paginas";
		?> 

		<?php
	/* 		for ($i=1;$i<=$paginas;$i++){
				if ($_SESSION['pagina']==$i){
					echo "<li class='active'><a href=?pagina=relatorio.php&nump=$i>$i</a></li>";
				}
				else {
					echo "<li><a href=?pagina=relatorio.php&nump=$i>$i</a></li>";
				}
			} */
		?>
		
		<?php
			if ($_SESSION['pagina']<$paginas){
				$posterior = $_SESSION['pagina']+1;
				echo "<button name='nump' class='btn btn-default pull-right' style='border-radius: 30px;' value=$paginas>Última</button>";
				echo "<button name='nump' class='btn btn-default pull-right' style='border-radius: 30px;' value=$posterior>Próxima <span aria-hidden='true'>&raquo;</span></button>";
			}
			else {
				echo "<button name='nump' class='btn btn-default pull-right' style='border-radius: 30px;' disabled>Última</button>";
				echo "<button name='nump' class='btn btn-default pull-right' style='border-radius: 30px;' disabled>Próxima <span aria-hidden='true'>&raquo;</span></button>";
			}

		?>
		</ul>
	<ul class="pager col-xs-3">
		<label class="control-label"><small> Exibir (número de itens)</small></label>
			<select class="form-control" name="numitems" onchange="submit()" style="padding: 0px; height: 22px;">
				<option value="" disabled selected>--</option>
				<option>30</option>
				<option>50</option>
				<option>100</option>
				<option>200</option>
				<option>500</option>
			</select>
	</ul>
</div>
