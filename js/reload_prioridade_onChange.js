$(document).ready(function() {
	$("#priority_changer").change(function(){
		$("#priority_changer_2").val('--');
		var tipo_menu = "";
		jQuery.ajax({
			type: "POST",
			url: "?pagina=select_prioridade.php",
			data: {tipo_menu : $("#priority_changer option:selected").val(), id_funcao: $("#id_funcao").val(), nome_menu: $("#nome_funcao").val()},
			success: function( data )
			{
				$("#select_priority").html(data);
			}
		});
		return false;
	});
});
$(document).ready(function() {
	$("#priority_changer_2").change(function(){
		$("#priority_changer").val('--');
		var tipo_menu = "";
		jQuery.ajax({
			type: "POST",
			url: "?pagina=select_prioridade.php",
			data: {tipo_menu : $("#priority_changer_2 option:selected").text(), id_funcao: $("#id_funcao").val(), nome_menu: $("#nome_funcao").val() },
			success: function( data )
			{
				$("#select_priority").html(data);
			}
		});
		return false;
	});
});