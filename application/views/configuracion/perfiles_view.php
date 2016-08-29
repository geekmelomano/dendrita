
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
            <article class="k-block k-shadow">
                <header class="k-header text-center">Menú del Grupo de Acceso</header>
                <div id="treeGrupoMenus"></div>
            </article>
        </div>
    </div>
</section>

<script>$(iniciarConfPerfiles);</script>
