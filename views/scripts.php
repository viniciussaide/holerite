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
	
	//Change glyphicon collapse right/down
	$('.collapse').on('shown.bs.collapse', function () {
		$(this).prev().find(".glyphicon").removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
	});
	//Change glyphicon collapse down/right
	$('.collapse').on('hidden.bs.collapse', function () {
		$(this).prev().find(".glyphicon").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
	});
	//Selecionar todos itens da lista prioridade
	$('#alterar').click(function() {
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