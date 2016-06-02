<?php $troca_senha = true;?>
<div class="modal fade" id="troca_senha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document" style="width:280px;margin-top:-210px;margin-left:-140px;">
	<div class="modal-content panel panel-danger">
	  <div class="modal-header panel-heading">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel" align=center><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><strong> Alteração de Senha</strong></h4>
	  </div>
	  <div class="modal-body panel-body">
		<div align=center><p><strong>Senha incorreta!</strong></p>
		</div>
		<div class='form-horizontal' style='text-align:center;'>
			<a class='btn btn-default btn-custom form-group' style='width:150px;' data-toggle='modal' data-target='#troca_senha'>Tente Novamente</a>
		</div>
	  </div>
	</div>
  </div>
</div>