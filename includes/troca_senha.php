<?php
if ((isset($_SESSION['posts']['senha_atual']))AND(isset($_SESSION['posts']['senha_nova']))AND(isset($_SESSION['posts']['senha_nova_2']))){
	include "includes/ChangePassword.php";
	unset ($_SESSION['posts']);
}
else {
	include "includes/form_troca_senha.php";
	unset ($_SESSION['posts']);
}
?>
<div>
</br>INICIO PERFIL DO USUÁRIO
</div>
<!--FIM GERENCIAR SENHA E CHAVE USUÁRIO-->
<!--INICIO PERFIL DO USUÁRIO-->
<div class="panel panel-info">
    <div class="panel-heading" style='text-align:center;'>
        <h3 class="panel-title"><strong>Colaborador: Fulano Ciclano de Beltrano</strong></h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-7 col-md-6">
                    <label class="col-sm-3 col-md-4 control-label">Matrícula</label>
                    <div class="col-sm-9 col-md-8">
                        <p class="form-control-static"> 20001234</p>
                    </div>
                    <label class="col-sm-3 col-md-4 control-label">CPF</label>
                    <div class="col-sm-9 col-md-8">
                        <p class="form-control-static">789.456.123-01</p>
                    </div>
                </div>
                <div class="col-sm-5 col-md-6">
                    <label class="col-sm-2 control-label">Cargo</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">Técnico de Teste</p>
                    </div>
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="exemplo@sankyu.com.br">
                                <span class="input-group-btn">
									<button class="btn btn-default" type="button">Editar</button>
                                </span>
                            </input>
                        </div>                    
                    </div>                                                                                                                                                        
                </div>
            </div>  
        </form>                        
    </div>
    <div class="form-inline pull-right">
    <p></p>
        <button type="submit" class="btn btn-primary">
            Salvar alterações
        </button>
        <button type="submit" class="btn btn-danger">
            Editar Senha
        </button>
    </div>
</div>