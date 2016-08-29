
<div id="gridEmpresas"></div>

<script type="x-kendo-template" id="tmplEmpresa">
    <form id="frmEmpresa" class="form-horizontal">
        <fieldset>
            <legend>Datos Generales</legend>
            <div class="form-group">
                <label for="codemp" class="col-sm-2 control-label">Código Interno:</label>
                <div class="col-sm-1">
                    <input id="codemp" type="text" class="form-control" required="true" autofocus="true" data-bind="value:codemp">
                </div>
            </div>
    
            <div class="form-group">
                <label for="nomemp" class="col-sm-2 control-label">Razón Social:</label>
                <div class="col-sm-4">
                    <input id="nomemp" type="text" class="form-control" required="true" data-bind="value:nomemp">
                </div>
                <label for="ruc" class="col-sm-1 control-label">R.U.C.:</label>
                <div class="col-sm-2">
                    <input id="ruc" type="text" class="form-control" data-bind="value:ruc">
                </div>
            </div>
    
            <div class="form-group">
                <label for="codgru" class="col-sm-2 control-label">Grupo Empr.:</label>
                <div class="col-sm-4">
                    <input id="codgru" type="text" class="form-control" data-bind="value:codgru">
                </div>
                <label for="estado" class="col-sm-1 control-label">Estado:</label>
                <div class="col-sm-2">
                    <input id="estado" type="text" class="form-control" data-bind="value:estado">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Direcciones</legend>
            <div class="form-group">
                <label for="dirfis" class="col-sm-2 control-label">Fiscal:</label>
                <div class="col-sm-8">
                    <input id="dirfis" type="text" class="form-control" data-bind="value:dirfis">
                </div>
            </div>
    
            <div class="form-group">
                <label for="dirleg" class="col-sm-2 control-label">Legal:</label>
                <div class="col-sm-8">
                    <input id="dirleg" type="text" class="form-control" data-bind="value:dirleg">
                </div>
            </div>
    
            <div class="form-group">
                <label for="ubigeo" class="col-sm-2 control-label">Ubigeo:</label>
                <div class="col-sm-1">
                    <input id="ubigeo" type="text" class="form-control" data-bind="value:ubigeo">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Representante Legal</legend>
            <div class="form-group">
                <label for="dniRepresentante" class="col-sm-2 control-label">D.N.I.:</label>
                <div class="col-sm-1">
                    <input id="dniRepresentante" type="text" class="form-control" data-bind="value:dni_representante">
                </div>
                <label for="nomRepresentante" class="col-sm-2 control-label">Apellid. y Nombres:</label>
                <div class="col-sm-4">
                    <input id="nomRepresentante" type="text" class="form-control" data-bind="value:nom_representante">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Datos del Negocio</legend>
            <div class="form-group">
                <label for="tipoNegocio" class="col-sm-2 control-label">Tipo de Negocio:</label>
                <div class="col-sm-2">
                    <input id="tipoNegocio" type="text" class="form-control" data-bind="value:tipo_negocio">
                </div>
                <label for="giroNegocio" class="col-sm-2 control-label">Giro de Negocio:</label>
                <div class="col-sm-3">
                    <input id="giroNegocio" type="text" class="form-control" data-bind="value:giro_negocio">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Datos de Contacto</legend>
            <div class="form-group">
                <label for="telefono" class="col-sm-2 control-label">Teléfono:</label>
                <div class="col-sm-2">
                    <input id="telefono" type="text" class="form-control" data-bind="value:telefono">
                </div>
                <label for="fax" class="col-sm-2 control-label">Fax:</label>
                <div class="col-sm-2">
                    <input id="fax" type="text" class="form-control" data-bind="value:fax">
                </div>
            </div>
    
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-3">
                    <input id="email" type="text" class="form-control" data-bind="value:email">
                </div>
                <label for="pagweb" class="col-sm-1 control-label">Sitio Web:</label>
                <div class="col-sm-3">
                    <input id="pagweb" type="text" class="form-control" data-bind="value:pagweb">
                </div>
            </div>
        </fieldset>
    </form>
</script>

<script>$(iniciarConfEmpresas);</script>
