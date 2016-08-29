
var campoRequerido = {
    validation: { required: true }
};

var campoNumeroRequerido = {
    type: 'number',
    validation: { required: true }
};

var campoFechaRequerido = {
    type: 'date',
    validation: { required: true }
};

var comandos = [ 
    { name: 'edit', text: { edit: '', update: '', cancel: '' } }, 
    { name: 'destroy', text: '' }
];

var comandosPopup = [
    { name: 'edit', text: { edit: '' } }, { name: 'destroy', text: '' }
];

$(function() {
    kendo.culture('es-PE');
    
    kendo.ui.progress($('.main'), true);
    $('.main').load(url + 'configuracion/confempresas', ocultarCargador);
    
    $('.sidebar a').on('click', function(evento) {
        evento.preventDefault();
        kendo.ui.progress($('.main'), true);
        var item = $(this).parent()[0];
        
        $('.main').load(url + $(this).attr('href'), function() {
            $('.sidebar li').removeClass('active');
            $(item).addClass('active');
            ocultarCargador();
        });
    });
    
    iniciarNotificador();
});

function ocultarCargador() {
    kendo.ui.progress($(this), false);
}

function crearFuenteDatos(idmodelo, campos, controlador) {
    return new kendo.data.DataSource({
        error: mostrarErrorDataSource,
        schema: {
            model: { id: idmodelo, fields: campos}
        },
        transport: {
            create: { type: 'POST', url: url + controlador + '/crear' },
            read: { url: url + controlador + '/obtener' },
            update: { type: 'POST', url: controlador + '/editar' },
            destroy: { type: 'POST', url: controlador + '/eliminar' }
        }
    });
}

/* Funciones y variables para mantenimiento de empresas */

var estadosEmpresas = [ { text: 'ACTIVO', value: 'S' }, { text: 'CERRADO', value: 'C' } ];

var columnasEmpresas = [
    { field: 'codemp', title: 'Código', width: 85, menu: false },
    { field: 'nomemp', title: 'Nombre', menu: false },
    { field: 'codgru', title: 'Grupo', width: 200, hidden: true, editor: iniciarEditGruposEmpresas },
    { field: 'dirfis', title: 'Dir. Física', hidden: true },
    { field: 'dirleg', title: 'Dir. Legal', hidden: true },
    { field: 'ubigeo', title: 'Ubigeo', width: 100, hidden: true },
    { field: 'ruc', title: 'R.U.C.', width: 100 },
    { field: 'telefono', title: 'Teléfono', width: 100, hidden: true },
    { field: 'fax', title: 'Fax', width: 100, hidden: true },
    { field: 'email', title: 'Email', hidden: true },
    { field: 'pagweb', title: 'Sitio Web', hidden: true },
    { field: 'reg_patronal', title: 'Reg. Patronal', width: 100, hidden: true },
    { field: 'giro_negocio', title: 'Giro Negocio', hidden: true },
    { field: 'tipo_negocio', title: 'Tipo Negocio', hidden: true },
    { field: 'nom_representante', title: 'Nombre Repr.', hidden: true },
    { field: 'dni_representante', title: 'D.N.I. Repr.', width: 100, hidden: true },
    { field: 'estado', title: 'Estado', width: 100, values: estadosEmpresas },
    { field: 'usuario', title: 'Usuario', width: 100, hidden: true },
    { field: 'nombrepc', title: 'PC', width: 100, hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', width: 100, hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandosPopup, title: '&nbsp', width: 100, menu: false }
];

var camposEmpresas = {
    codemp: campoRequerido,
    nomemp: campoRequerido,
    codgru: {},
    dirfis: {},
    dirleg: {},
    ubigeo: {},
    ruc: {},
    telefono: {},
    fax: {},
    email: {  },
    pagweb: {},
    reg_patronal: {},
    giro_negocio: {},
    tipo_negocio: {},
    nom_representante: {},
    dni_representante: {},
    estado: {},
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' }
};

function iniciarConfEmpresas() {
    $('#gridEmpresas').kendoGrid({
        columns: columnasEmpresas,
        columnMenu: true,
        dataSource: crearFuenteDatos('codemp', camposEmpresas, 'empresa'),
        editable: {
            createAt: 'bottom',
            mode: 'popup',
            template: kendo.template($('#tmplEmpresa').html()),
            window: { title: 'INFORMACION DE LA EMPRESA', width: 750 }
        },
        excel: { fileName: 'Empresas.xlsx', filterable: true },
        filterable: true,
        height: $(window).height() - 210,
        noRecords: true,
        pageable: { numeric: false, pageSize: 20, previousNext: false, refresh: true },
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}

function iniciarEditGruposEmpresas(contenedor, opciones) {
    $('<input name="' + opciones.field + '" />').appendTo(contenedor)
            .kendoDropDownList({
                autoBind: false,
                dataTextField: 'nom_empresa_grupo',
                dataValueField: 'cod_empresa_grupo',
                dataSource: {
                    transport: { read: url + 'grupoempresa/obtener' }
                }
            });
}

/* Funciones y variables para mantenimiento de localidades */

var columnasLocales = [
    { field: 'codloc', title: 'Código', width: 85, menu: false },
    { field: 'nomloc', title: 'Nombre', menu: false },
    { field: 'ubigeo', title: 'Ubigeo' },
    { field: 'usuario', title: 'Usuario', width: 100, hidden: true },
    { field: 'nombrepc', title: 'PC', width: 100, hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', width: 100, hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandos, title: '&nbsp', width: 100, menu: false }
];

var camposLocales = {
    codloc: campoRequerido,
    nomloc: campoRequerido,
    ubigeo: {},
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' }
};

function iniciarConfLocales() {
    $('#gridLocales').kendoGrid({
        columns: columnasLocales,
        columnMenu: true,
        dataSource: crearFuenteDatos('codloc', camposLocales, 'localidad'),
        editable: { createAt: 'bottom', mode: 'inline' },
        excel: { fileName: 'Localidades.xlsx', filterable: true },
        filterable: true,
        height: $(window).height() - 210,
        noRecords: true,
        pageable: { numeric: false, pageSize: 20, previousNext: false, refresh: true },
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}

/* Funciones y variables para mantenimiento de grupos de empresas */

var columnasGruposEmpresas = [
    { field: 'cod_empresa_grupo', title: 'Código', width: 85, menu: false },
    { field: 'nom_empresa_grupo', title: 'Nombre', menu: false },
    { field: 'observacion', title: 'Observación' },
    { field: 'usuario', title: 'Usuario', width: 100, hidden: true },
    { field: 'nombrepc', title: 'PC', width: 100, hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', width: 100, hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandos, title: '&nbsp', width: 100, menu: false }
];

var camposGruposEmpresas = {
    cod_empresa_grupo: campoRequerido,
    nom_empresa_grupo: campoRequerido,
    observacion: {},
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' }
};

function iniciarConfGruposEmpresas() {
    $('#gridGruposEmpresas').kendoGrid({
        columns: columnasGruposEmpresas,
        columnMenu: true,
        dataSource: crearFuenteDatos('cod_empresa_grupo', camposGruposEmpresas, 'grupoempresa'),
        editable: { createAt: 'bottom', mode: 'inline' },
        excel: { fileName: 'GruposEmpresas.xlsx', filterable: true },
        filterable: true,
        height: $(window).height() - 210,
        noRecords: true,
        pageable: { numeric: false, pageSize: 20, previousNext: false, refresh: true },
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}

/* Funciones y variables para mantenimiento de sistemas */

var estadosSistemas = [ 
    { text: 'CON ACCESO', value: '1' },
    { text: 'SOLO LECTURA', value: '9' },
    { text: 'SIN ACCESO', value: 'X' }
];

var columnasSistemas = [
    { field: 'codsis', title: 'Código', width: 85, menu: false },
    { field: 'nomsis', title: 'Nombre', menu: false },
    { field: 'nom_basedato', title: 'Base de Datos' },
    { field: 'nom_servidor', title: 'Servidor' },
    { field: 'cod_acceso', title: 'Acceso', hidden: true },
    { field: 'imagen', title: 'Imagen' },
    { field: 'ventana', title: 'Ventana', hidden: true },
    { field: 'menu', title: 'Menu', hidden: true },
    { field: 'estado', title: 'Estado', width: 100, values: estadosSistemas },
    { field: 'usuario', title: 'Usuario', width: 100, hidden: true },
    { field: 'nombrepc', title: 'PC', width: 100, hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', width: 100, hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandosPopup, title: '&nbsp;', width: 100, menu: false }
];

var camposSistemas = {
    codsis: campoRequerido,
    nomsis: campoRequerido,
    nom_basedato: campoRequerido,
    nom_servidor: campoRequerido,
    cod_acceso: campoRequerido,
    imagen: campoRequerido,
    ventana: campoRequerido,
    menu: campoRequerido,
    estado: campoRequerido,
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' }
};

var sistema;

function iniciarConfSistemas() {
    $('#gridSistemas').kendoGrid({
        columns: columnasSistemas,
        columnMenu: true,
        dataSource: crearFuenteDatos('codsis', camposSistemas, 'sistema'),
        detailInit: iniciarDetalleConfSistemas,
        detailTemplate: kendo.template($('#tmplSistemasDet').html()),
        editable: {
            createAt: 'bottom',
            mode: 'popup',
            window: { title: 'INFORMACION DEL SISTEMA' }
        },
        excel: { fileName: 'Sistemas.xlsx', filterable: true },
        filterable: true,
        height: $(window).height() - 170,
        noRecords: true,
        pageable: { numeric: false, pageSize: 20, previousNext: false, refresh: true },
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}

function iniciarDetalleConfSistemas(evento) {
    sistema = evento.data;
    iniciarConfSistemasEmpresas(evento.detailRow.find('.gridSistemasEmpresas'));
}

/* Funciones y variables para la configuracion de sistemas, empresas y locales */

var meses = [
    { text: 'ENERO', value: 1 }, { text: 'FEBRERO', value: 2 },
    { text: 'MARZO', value: 3 }, { text: 'ABRIL', value: 4 },
    { text: 'MAYO', value: 5 }, { text: 'JUNIO', value: 6 },
    { text: 'JULIO', value: 7 }, { text: 'AGOSTO', value: 8 },
    { text: 'SEPTIEMBRE', value: 9 }, { text: 'OCTUBRE', value: 10 },
    { text: 'NOVIEMBRE', value: 11 }, { text: 'DICIEMBRE', value: 12 }
];

var columnasSistemasEmpresas = [
    { field: 'codsis', title: 'Sistema', hidden: true, editor: iniciarEditorSistemas },
    { field: 'codemp', title: 'Empresa', menu: false, editor: iniciarEditorEmpresas },
    { field: 'codloc', title: 'Local', menu: false, editor: iniciarEditorLocales },
    { field: 'estado', title: 'Estado', width: 100, values: estadosSistemas },
    { field: 'anio', title: 'Año', width: 100 },
    { field: 'mes', title: 'Mes', width: 100, values: meses },
    { field: 'fectra_inicial', title: 'Inicio', width: 100, format: '{0:dd/MM/yyyy}' },
    { field: 'fectra_final', title: 'Final', width: 100, format: '{0:dd/MM/yyyy}' },
    { field: 'usuario', title: 'Usuario', width: 100, hidden: true },
    { field: 'nombrepc', title: 'PC', width: 100, hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', width: 100, hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandosPopup, title: '&nbsp;', width: 100, menu: false }
];

var camposSistemasEmpresas = {
    codsis: {
        defaultValue: function(e) {
            return sistema.codsis;
        },
        editable: false,
        validation: { required: true }
    },
    codemp: campoRequerido,
    codloc: campoRequerido,
    estado: campoRequerido,
    anio: campoNumeroRequerido,
    mes: campoNumeroRequerido,
    fectra_inicial: campoFechaRequerido,
    fectra_final: campoFechaRequerido,
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' }
};

var fuenteSistemasEmpresas = new kendo.data.DataSource({
    error: mostrarErrorDataSource,
    schema: {
        model: { id: 'id', fields: camposSistemasEmpresas },
        parse: function(respuesta) {
            for (var i = 0; i < respuesta.length; i++) {
                respuesta[i].id = respuesta[i].codsis + respuesta[i].codemp + respuesta[i].codloc;
            }
            
            return respuesta;
        }
    },
    serverFiltering: true,
    transport: {
        create: { type: 'POST', url: url + 'sistemaempresalocalidad/crear' },
        read: { url: url + 'sistemaempresalocalidad/obtenerPorSistema' },
        update: { type: 'POST', url: url + 'sistemaempresalocalidad/editar' },
        destroy: { type: 'POST', url: url + 'sistemaempresalocalidad/eliminar' }
    }
});

function iniciarConfSistemasEmpresas(elemento) {
    fuenteSistemasEmpresas.filter({ field: 'codsis', operator: 'eq', value: sistema.codsis });
    
    elemento.kendoGrid({
        columns: columnasSistemasEmpresas,
        columnMenu: true,
        dataSource: fuenteSistemasEmpresas,
        editable: {
            createAt: 'bottom',
            mode: 'popup',
            window: { title: 'CONFIGURACION DE EMPRESA Y LOCAL' }
        },
        excel: { fileName: 'SistemaEmpresaLocalidad.xlsx', filterable: true },
        filterable: true,
        height: 250,
        noRecords: true,
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}

function iniciarEditorSistemas(contenedor, opciones) {
    $('<input name="' + opciones.field + '" />').appendTo(contenedor)
            .kendoDropDownList({
                dataSource: {
                    transport: { read: url + 'sistema/obtener' }
                },
                dataTextField: 'nomsis',
                dataValueField: 'codsis'
            });
}

function iniciarEditorEmpresas(contenedor, opciones) {
    $('<input name="' + opciones.field + '" />').appendTo(contenedor)
            .kendoDropDownList({
                dataSource: {
                    transport: { read: url + 'empresa/obtener' }
                },
                dataTextField: 'nomemp',
                dataValueField: 'codemp'
            });
}

function iniciarEditorLocales(contenedor, opciones) {
    $('<input name="' + opciones.field + '" />').appendTo(contenedor)
            .kendoDropDownList({
                dataSource: {
                    transport: { read: url + 'localidad/obtener' }
                },
                dataTextField: 'nomloc',
                dataValueField: 'codloc'
            });
}

/* Funciones y variables para mantenimiento de reglas de acceso */

var listaSistemas;

function iniciarConfPerfiles() {
    listaSistemas = $('#listaSistemas').kendoDropDownList({
        dataSource: {
            transport: { read: url + 'sistema/obtener' }
        },
        dataTextField: 'nomsis',
        dataValueField: 'codsis'
    }).data('kendoDropDownList');
    
    $('#tabPerfilesReglas').kendoTabStrip({
        animation: {
            open: { effects: 'fadeIn' }
        },
        contentUrls: [ url + 'reglaaccesoempresa', url + 'sistemagrupo' ]
    });
}

var columnasReglasAcceso = [
    { field: 'cod_regla', title: 'Código', width: 85, menu: false },
    { field: 'codsis', title: 'Sistema', width: 100, hidden: true, menu: false },
    { field: 'nom_regla', title: 'Nombre', menu: false },
    { field: 'observacion', title: 'Descripción' },
    { field: 'usuario', title: 'Usuario', hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandos, title: '&nbsp;', width: 100, menu: false }
];

var camposReglasAcceso = {
    cod_regla: campoRequerido,
    codsis: {
        defaultValue: function() {
            return listaSistemas.value();
        },
        editable: false,
        validation: { required: true }
    },
    nom_regla: campoRequerido,
    observacion: campoRequerido,
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' }
};

var fuenteReglasAcceso = new kendo.data.DataSource({
    error: mostrarErrorDataSource,
    schema: {
        model: { id: 'cod_regla', fields: camposReglasAcceso }
    },
    serverFiltering: true,
    transport: {
        create: { type: 'POST', url: url + 'reglaaccesoempresa/crear' },
        read: { url: url + 'reglaaccesoempresa/obtenerPorSistema' },
        update: { type: 'POST', url: url + 'reglaaccesoempresa/editar' },
        destroy: { type: 'POST', url: url + 'reglaaccesoempresa/eliminar' }
    }
});

var reglaAcceso;

function iniciarConfReglasAcceso() {
    fuenteReglasAcceso.filter({ field: 'codsis', operator: 'eq', value: listaSistemas.value() });
    
    $('#gridReglasAcceso').kendoGrid({
        columns: columnasReglasAcceso,
        columnMenu: true,
        dataSource: fuenteReglasAcceso,
        detailInit: iniciarConfReglasAccesoDet,
        detailTemplate: kendo.template($('#tmplReglasAccesoDet').html()),
        editable: { createAt: 'bottom', mode: 'inline' },
        excel: { fileName: 'ReglasAccesoEmpresa.xlsx', filterable: true },
        filterable: true,
        height: $(window).height() - 210,
        pageable: { numeric: false, pageSize: 20, previousNext: false, refresh: true },
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}

function iniciarConfReglasAccesoDet(evento) {
    reglaAcceso = evento.data;
    
    fuenteReglasAccesoDet.filter([
        { field: 'cod_regla', operator: 'eq', value: reglaAcceso.cod_regla },
        { field: 'codsis', operator: 'eq', value: reglaAcceso.codsis }
    ]);
    
    evento.detailRow.find('.gridReglasAccesoDet').kendoGrid({
        columns: columnasReglasAccesoDet,
        columnMenu: true,
        dataSource: fuenteReglasAccesoDet,
        editable: { createAt: 'bottom', mode: 'inline' },
        excel: { fileName: 'ReglasAccesoEmpresaDet.xlsx', filterable: true },
        filterable: true,
        height: 250,
        noRecords: true,
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}

/* Funciones y variables para mantenimiento de detalle de reglas de acceso. */

var columnasReglasAccesoDet = [
    { field: 'cod_regla', title: 'Regla', hidden: true, menu: false },
    { field: 'codsis', title: 'Sistema', hidden: true, menu: false },
    { field: 'codemp', title: 'Empresa', menu: false, editor: iniciarEditorEmpresas },
    { field: 'codloc', title: 'Localidad', menu: false, editor: iniciarEditorLocales },
    { field: 'usuario', title: 'Usuario', width: 100, hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', width: 150, hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandos, title: '&nbsp;', width: 100, menu: false }
];

var camposReglasAccesoDet = {
    cod_regla: {
        defaultValue: function() {
            return reglaAcceso.cod_regla;
        },
        editable: false,
        validation: { required: true }
    },
    codsis: {
        defaultValue: function() {
            return reglaAcceso.codsis;
        },
        editable: false,
        validation: { required: true }
    },
    codemp: campoRequerido,
    codloc: campoRequerido,
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' }
};

var fuenteReglasAccesoDet = new kendo.data.DataSource({
    error: mostrarErrorDataSource,
    schema: {
        model: { id: 'id', fields: camposReglasAccesoDet },
        parse: function(respuesta) {
            for (var i = 0; i < respuesta.length; i++) {
                respuesta[i].id = respuesta[i].cod_regla + respuesta[i].codsis + 
                        respuesta[i].codemp + respuesta[i].codloc;
            }
            
            return respuesta;
        }
    },
    serverFiltering: true,
    transport: {
        create: { type: 'POST', url: url + 'reglaaccesoempresadet/crear' },
        read: { url: url + 'reglaaccesoempresadet/obtenerPorReglaYSistema' },
        update: { type: 'POST', url: url + 'reglaaccesoempresadet/editar' },
        destroy: { type: 'POST', url: url + 'reglaaccesoempresadet/eliminar' }
    }
});

/* Funciones y variables para mantenimiento de grupos de sistemas. */

var comandosSistemasGrupos = [ 
    { name: 'edit', text: { edit: '', update: '', cancel: '' } }, 
    { name: 'destroy', text: '' },
    { name: 'vermenus', text: 'Menus...', click: iniciarDetalleSistemaGrupo }
];

var columnasSistemaGrupos = [
    { field: 'cod_sisgrupo', title: 'Código', width: 85, menu: false },
    { field: 'codsis', title: 'Sistema', width: 100, menu: false, hidden: true },
    { field: 'nom_sisgrupo', title: 'Nombre', menu: false },
    { field: 'observacion', title: 'Observación' },
    { field: 'usuario', title: 'Usuario', width: 100, hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', width: 150, hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandosSistemasGrupos, title: '&nbsp;', width: 175, menu: false }
];

var camposSistemaGrupos = {
    cod_sisgrupo: campoRequerido,
    codsis: {
        defaultValue: function() {
            return listaSistemas.value();
        },
        editable: false,
        validation: { required: true }
    },
    nom_sisgrupo: campoRequerido,
    observacion: {},
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' }
};

var fuenteSistemaGrupos = new kendo.data.DataSource({
    error: mostrarErrorDataSource,
    schema: {
        model: { id: 'cod_sisgrupo', fields: camposSistemaGrupos }
    },
    serverFiltering: true,
    transport: {
        create: { type: 'POST', url: url + 'sistemagrupo/crear' },
        read: { url: url + 'sistemagrupo/obtenerPorSistema' },
        update: { type: 'POST', url: url + 'sistemagrupo/editar' },
        destroy: { type: 'POST', url: url + 'sistemagrupo/eliminar' }
    }
});

var sistemaGrupo;

function iniciarConfSistemaGrupos() {
    fuenteSistemaGrupos.filter({ field: 'codsis', operator: 'eq', value: listaSistemas.value() });
    
    $('#gridSistemaGrupos').kendoGrid({
        columns: columnasSistemaGrupos,
        columnMenu: true,
        dataSource: fuenteSistemaGrupos,
        editable: { createAt: 'bottom', mode: 'inline' },
        excel: { fileName: 'SistemaGrupos.xlsx', filterable: true },
        filterable: true,
        height: $(window).height() - 210,
        pageable: { numeric: false, pageSize: 20, previousNext: false, refresh: true },
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}

function iniciarDetalleSistemaGrupo(evento) {
    evento.preventDefault();
    sistemaGrupo = this.dataItem($(evento.target).closest('tr'));
    
    iniciarConfSistemaMenus(sistemaGrupo.codsis);
    iniciarConfGrupoMenus(sistemaGrupo.codsis, sistemaGrupo.cod_sisgrupo);
    
    $('#nombreSistema').text(listaSistemas.text());
    $('#nombreGrupo').text(sistemaGrupo.nom_sisgrupo);
    
    $('#crudReglasMenus').slideUp(function() {
        $('#crudGruposMenus').slideDown();
    });
}

/* Funciones y variables para obtener los menus de un sistema */

var modeloSistemaMenus = { 
    id: 'cod_menu', 
    hasChildren: 'espadre',
    fields: {
        espadre: { type: 'number' }
    }
};

var treeGrupoMenus;

function iniciarConfSistemaMenus(codSistema) {
    $('#treeSistemaMenus').height($(window).height() - 210).kendoTreeView({
        dataSource: new kendo.data.HierarchicalDataSource({
            schema: { model: modeloSistemaMenus },
            transport: {
                read: {
                    data: { codsis: codSistema },
                    url: url + 'sistemamenu/obtenerPorPadre'
                }
            }
        }),
        dataTextField: 'nom_menu',
        dragAndDrop: true,
        drop: function(evento) {
            var menu = this.dataItem(evento.sourceNode);
            
            switch (evento.dropPosition) {
                case 'over': treeGrupoMenus.append(menu, $(evento.destinationNode)); break;
                case 'before': treeGrupoMenus.insertBefore(menu, $(evento.destinationNode)); break;
                case 'after': treeGrupoMenus.insertAfter(menu, $(evento.destinationNode)); break;
            }
            
            evento.preventDefault();
        }
    });
}

function iniciarConfGrupoMenus(codSistema, codSisGrupo) {
    treeGrupoMenus = $('#treeGrupoMenus').height($(window).height() - 210).kendoTreeView({
        dataSource: new kendo.data.HierarchicalDataSource({
            schema: { model: modeloSistemaMenus },
            transport: {
                create: { type: 'POST', url: url + 'sistemagrupomenu/crear' },
                read: {
                    data: { codsis: codSistema, cod_sisgrupo: codSisGrupo },
                    url: url + 'sistemagrupomenu/obtenerPorGrupoYPadre'
                },
                update: { type: 'POST', url: url + 'sistemagrupomenu/editar' },
                destroy: { type: 'POST', url: url + 'sistemagrupomenu/eliminar' }
            }
        }),
        dataTextField: 'nom_menu',
        dragAndDrop: true,
        drop: function(evento) {
            evento.preventDefault();
            
            if (confirm('Realmente desea eliminar este menú del grupo de acceso?')) {
                this.remove(evento.sourceNode);
            }
        }
    }).data('kendoTreeView');
}

/* Funciones y variables para mantenimiento de usuarios */

var estadosUsuarios = [ { text: 'ACTIVO', value: 'A' }, { text: 'DE BAJA', value: 'X' } ];
var tiposUsuarios = [ { text: 'ADMINISTRADOR', value: '99' }, { text: 'USUARIO', value: '01' } ];

var columnasUsuarios = [
    { field: 'cod_usuario', title: 'Código', width: 85, menu: false },
    { field: 'nom_usuario', title: 'Nombre', menu: false },
    { field: 'cargo', title: 'Cargo' },
    { field: 'area', title: 'Area' },
    { field: 'dni', title: 'D.N.I.', width: 100 },
    { field: 'estado', title: 'Estado', width: 100, values: estadosUsuarios },
    { field: 'usuario', title: 'Usuario', width: 100, hidden: true },
    { field: 'nombrepc', title: 'PC', width: 100, hidden: true },
    { field: 'fechamodificacion', title: 'Fecha', width: 100, hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { field: 'carpeta_files', title: 'Carpeta', hidden: true },
    { field: 'tipo_usuario', title: 'Tipo', width: 100, values: tiposUsuarios },
    { field: 'clave1', title: 'Clave', hidden: true },
    { field: 'fec_creacion', title: 'Fecha de creación', hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { field: 'fec_cambio_clave', title: 'Cambio de clave', hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { field: 'fec_expira_clave', title: 'Expira', hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { field: 'fec_baja', title: 'Fecha de baja', hidden: true, format: '{0:dd/MM/yyyy hh:mm}' },
    { command: comandosPopup, title: '&nbsp;', width: 100, menu: false }
];

var camposUsuarios = {
    cod_usuario: campoRequerido,
    nom_usuario: campoRequerido,
    cargo: {},
    area: {},
    dni: {},
    estado: campoRequerido,
    usuario: { editable: false },
    nombrepc: { editable: false },
    fechamodificacion: { editable: false, type: 'date' },
    carpeta_files: {},
    tipo_usuario: {},
    clave1: {},
    fec_creacion: { editable: false, type: 'date' },
    fec_cambio_clave: { type: 'date' },
    fec_expira_clave: { type: 'date' },
    fec_baja: { type: 'date' }
};

function iniciarConfUsuarios() {
    $('#gridUsuarios').kendoGrid({
        columns: columnasUsuarios,
        columnMenu: true,
        dataSource: crearFuenteDatos('cod_usuario', camposUsuarios, 'usuario'),
        editable: {
            createAt: 'bottom',
            mode: 'popup',
            window: { title: 'Detalle del Usuario' }
        },
        excel: { fileName: 'Usuarios.xlsx', filterable: true },
        filterable: true,
        height: $(window).height() - 230,
        pageable: { numeric: false, pageSize: 20, previousNext: false, refresh: true },
        reorderable: true,
        resizable: true,
        sortable: true,
        toolbar: [ 'create', 'excel' ]
    });
}
