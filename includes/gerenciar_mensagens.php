<div class='row form-inline'>
    <ul class="pager col-xs-9">
        <button name='nump' class='btn btn-default pull-left' style='border-radius: 30px;'
        disabled>
            Primeira
        </button>
        <button name='nump' class='btn btn-default pull-left' style='border-radius: 30px;'
        disabled>
            <span aria-hidden='true'>
                &laquo;
            </span>
            Anterior
        </button>
        Página 1 de 74
        <button name='nump' class='btn btn-default pull-right' style='border-radius: 30px;'
        value=74>
            Última
        </button>
        <button name='nump' class='btn btn-default pull-right' style='border-radius: 30px;'
        value=2>
            Próxima
            <span aria-hidden='true'>
                &raquo;
            </span>
        </button>
    </ul>
    <ul class="pager col-xs-3">
        <label class="control-label">
            <small>
                Exibir (número de itens)
            </small>
        </label>
        <select class="form-control" name="numitems" onchange="submit()" style="padding: 0px; height: 22px;">
            <option value="" disabled selected>
                --
            </option>
            <option>
                30
            </option>
            <option>
                50
            </option>
            <option>
                100
            </option>
            <option>
                200
            </option>
            <option>
                500
            </option>
        </select>
    </ul>
</div>
<div class="well clearfix">
    <div class="row">
        <div class="col-xs-4">
            <div class="input-group">
                <input type='text' name='txt_busca' class='form-control' placeholder='Nome ou matrícula'>
                </input>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name='busca'>
                        <span class="glyphicon glyphicon-search" aria-hidden="true">
                        </span>
                        Buscar
                    </button>
                </span>
            </div>
        </div>
        <div class="col-xs-1">
            
        </div>
        <div class="col-xs-7">
            <button name='nump' class='btn btn-default' style='border-radius: 30px;' value=>
                Nova Mensagem
            </button>
        </div>
    </div>
    </p>

    <div class="row">
        <div class="col-md-3">
            <button class='btn btn-link form-control' type='submit' value='Desc_mat' name='order'>
                <b>
                    <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                    </span>
                        Título
                </b>
            </button>
        </div>
        <div class="col-md-3">
            <button class='btn btn-link form-control' type='submit' value='Desc_nome' name='order'>
                <b>
                    <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                    </span>
                        Descrição
                </b>
            </button>
        </div>
        <div class="col-md-6">
            <button class='btn btn-link form-control' type='submit' value='Desc_data' name='order'>
                <b>
                    <span class='glyphicon glyphicon-menu-down' aria-hidden='true'>
                    </span>
                        Mensagem
                </b>
            </button>
        </div>
    </div>
    
<!--INICIO DAS MENSAGENS-->
    <div class="row">
        <div class="col-md-3">      
            <p align="justify">
                <b>
                    <a>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </a>
                </b>
            </p>
        </div>
        <div class="col-md-3">
            <p align="justify">
                <b>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc accumsan mauris lacus, quis vulputate ex condimentum eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </b>
            </p>
        </div>
        <div class="col-md-6">
            <p align="justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc accumsan mauris lacus, quis vulputate ex condimentum eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique purus et mi pharetra, non aliquet nisl molestie. Donec malesuada mollis augue eu interdum. Aenean quis dui in tortor gravida tempor. Fusce vel sollicitudin enim. Ut elementum mattis nunc, ac sollicitudin arcu mollis non. Pellentesque sit amet massa ipsum. Pellentesque et tempor magna.
            </p>
        </div>
    </div>
<!--FIM DAS MENSAGENS-->       
    <div class="input-group pull-right">
    </div>
</div>
<div>
<p align="center">_________________________________________________</p>
</div>
<!--INICIO DA EDIÇÃO DE MENSAGENS-->
<div class="well clearfix">
<form class="form-group">
    <div class="row">
        <div class="row">
            <div class="col-md-1">
                <p align="center">
                    <b>
                        Título
                    </b>
                </p>
            </div>
            <div class="col-md-11">
                <textarea class="form-control" rows="1" placeholder="Título" maxlength="55" cols="100"></textarea>
                </br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <p align="center">
                    <b>
                        Descrição
                    </b>
                </p>
            </div>
            <div class="col-md-11">
                <textarea class="form-control" placeholder="Descrição" rows="3" maxlength="300"></textarea>
                </br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <p align="center">
                    <b>
                        Mensagem
                    </b>
                </p>
            </div>
            <div class="col-md-11">
                <textarea class="form-control" placeholder="Mensagem" rows="5" maxlength="2500"></textarea>
                </br>
                <div class="form-inline pull-right">
                    <button name='nump' class='btn btn-danger'>
                        Cancelar
                    </button>
                    <button name='nump' class='btn btn-success'>
                        Salvar
                    </button>
                </div>
            </div>    
        </div>
    </div>
</form>
</div>
<div>
<!--FIM DA EDIÇÃO DE MENSAGENS-->
<p align="center">_________________________________________________</p>
</div>
<!--INICIO DA EDIÇÃO DE MENSAGENS-->
<div class="well clearfix">
    <form class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <p align="center">
                            <b>
                                Título
                            </b>
                        </p>
                    </div>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="1" placeholder="Título" maxlength="55" cols="100"></textarea>
                        </br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p align="center">
                            <b>
                                Descrição
                            </b>
                        </p>
                    </div>
                    <div class="col-md-10">
                        <textarea class="form-control" placeholder="Descrição" rows="3" maxlength="300"></textarea>
                        </br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <p align="center">
                            <b>
                                Mensagem
                            </b>
                        </p>
                    </div>
                    <div class="col-md-10">
                    <textarea class="form-control" placeholder="Mensagem" rows="5" maxlength="2500"></textarea>
                    </br>
                    
                    <div class="form-inline pull-right">
                        <button name='nump' class='btn btn-danger'>
                            Cancelar
                        </button>
                        <button name='nump' class='btn btn-success'>
                            Salvar
                        </button>
                    </div>
                    
                </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="well">
                    <form class="form-vertical">
                    <div class="form-group">
                        <label>
                        <input type="checkbox"> Lorem ipsum dolor sit amet</input>
                        </label>
                        <label>
                        <input type="checkbox"> Lorem ipsum dolor sit amet</input>
                        </label>
                        <label>
                        <input type="checkbox"> Lorem ipsum dolor sit amet</input>
                        </label>
                    </div>    
                    </form>
                </div>
            </div>
        </div>
    </form>
</div>
<div>
<!--FIM DA EDIÇÃO DE MENSAGENS-->
<p align="center">_________________________________________________</p>
</div>

<div class='row form-inline'>
    <ul class="pager col-xs-9">
        <button name='nump' class='btn btn-default pull-left' style='border-radius: 30px;' disabled>
            Primeira
        </button>
        <button name='nump' class='btn btn-default pull-left' style='border-radius: 30px;' disabled>
            <span aria-hidden='true'>
                &laquo;
            </span>
            Anterior
        </button>
        Página 1 de 74
        <button name='nump' class='btn btn-default pull-right' style='border-radius: 30px;' value=74>
            Última
        </button>
        <button name='nump' class='btn btn-default pull-right' style='border-radius: 30px;' value=2>
            Próxima
            <span aria-hidden='true'>
                &raquo;
            </span>
        </button>
    </ul>
    <ul class="pager col-xs-3">
        <label class="control-label">
            <small>
                Exibir (número de itens)
            </small>
        </label>
        <select class="form-control" name="numitems" onchange="submit()" style="padding: 0px; height: 22px;">
            <option value="" disabled selected>
                --
            </option>
            <option>
                30
            </option>
            <option>
                50
            </option>
            <option>
                100
            </option>
            <option>
                200
            </option>
            <option>
                500
            </option>
        </select>
    </ul>
</div>