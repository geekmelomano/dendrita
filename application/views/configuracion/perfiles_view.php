
<section id="crudReglasMenus">
    <div class="pull-right">Sistema:
        <input id="listaSistemas">
    </div>

    <h1 class="page-header">PERFILES &amp; REGLAS DE ACCESO</h1>

    <div id="tabPerfilesReglas">
        <ul>
            <li class="k-state-active">Reglas de Acceso</li>
            <li>Grupos de Menús</li>
        </ul>
    </div>
</section>

<section id="crudGruposMenus">
    <h1 class="page-header">MENUS Y RESTRICCIONES
        <small>Sistema: <span id="nombreSistema"></span> - Grupo: <span id="nombreGrupo"></span></small>
    </h1>
    
    <div class="row">
        <div class="col-sm-4">
            <article class="k-block k-shadow">
                <header class="k-header text-center">Menú Principal</header>
                <div id="treeSistemaMenus"></div>
            </article>
        </div>
        
        <div class="col-sm-8">
            <article id="viewGrupoMenu" class="k-block k-shadow">
                <header class="k-header text-center">Menú del Grupo de Acceso</header>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div id="treeGrupoMenus" data-role="treeview" data-drag-and-drop="true" 
                             data-text-field="nom_menu"
                             data-bind="source: fuenteDatos, events: { change: mostrarDetalle, drop: procesarSoltado }">
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <form id="frmSistemaGrupoMenu" data-bind="visible: editable">
                            <fieldset>
                                <legend><span data-bind="text: seleccionado.nom_menu"></span></legend>
                                
                                <ul>
                                    <li>CREAR
                                        <input type="checkbox" data-bind="checked: seleccionado.crear, events: { change: procesarCambio }">
                                    </li>
                                    <li>MODIFICAR
                                        <input type="checkbox" data-bind="checked: seleccionado.modificar, events: { change: procesarCambio }">
                                    </li>
                                    <li>CONSULTAR
                                        <input type="checkbox" data-bind="checked: seleccionado.consultar, events: { change: procesarCambio }">
                                    </li>
                                    <li>ELIMINAR
                                        <input type="checkbox" data-bind="checked: seleccionado.eliminar, events: { change: procesarCambio }">
                                    </li>
                                    <li>PROCESAR
                                        <input type="checkbox" data-bind="checked: seleccionado.procesar, events: { change: procesarCambio }">
                                    </li>
                                    <li>ESPECIAL 1
                                        <input type="checkbox" data-bind="checked: seleccionado.especial01, events: { change: procesarCambio }">
                                    </li>
                                    <li>ESPECIAL 2
                                        <input type="checkbox" data-bind="checked: seleccionado.especial02, events: { change: procesarCambio }">
                                    </li>
                                </ul>
                            </fieldset>
                        </form>
                        
                        <button class="k-button k-primary" data-bind="click: guardar, enabled: editado">Guardar cambios</button>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<script>$(iniciarConfPerfiles);</script>
