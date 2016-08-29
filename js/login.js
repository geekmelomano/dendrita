
$(function() {
    kendo.ui.progress($(document.body), true);
    
    $('#rootwizard').bootstrapWizard({
        tabClass: 'nav nav-pills nav-justified',
        onTabClick: function(tab, navigation, index) {
            console.log('On tab click disabled');
            return false;
        }
    });
    
    iniciarNotificador();
    $('#frmUsuario').on('submit', iniciarSesion);
    kendo.ui.progress($(document.body), false);
});

function iniciarSesion(evento) {
    evento.preventDefault();
    $('#btnLoginContinuar').button('loading');
        
    $.post(url + 'usuario/autenticar', { 
        cod_usuario: $('#inputUsuario').val(), 
        clave: $('#inputClave').val() 
    }).done(function(datos, estado, peticion) {
        if (datos.estado === 'success') listarSistemas();
        else notificacion.show(datos.mensaje, datos.estado);
    }).fail(mostrarErrorAjax).always(function()  {
        $('#btnLoginContinuar').button('reset');
    });
}

function listarSistemas() {
    $('#rootwizard').bootstrapWizard('next');
    
    $('#listaSistemas').kendoListView({
        change: function(evento) {
            kendo.ui.progress($('#listaSistemas'), true);
            
            $.post(url + 'sistema/recordar', { 
                codsis: this.dataItem(this.select()).codsis
            }).done(function(datos, estado, peticion) {
                if (datos.estado === 'success') listarEmpresas();
                else notificacion.show(datos.mensaje, datos.estado);
            }).fail(mostrarErrorAjax).always(function() {
                kendo.ui.progress($('#listaSistemas'), false);
            });
        },
        dataSource: {
            error: mostrarErrorDataSource,
            transport: { read: url + 'sistema/obtenerPorSesion' }
        },
        selectable: true,
        template: kendo.template($('#tmplSistema').html())
    });
}

function listarEmpresas() {
    $('#rootwizard').bootstrapWizard('next');
    
    var empresa = $('#inputEmpresa').kendoDropDownList({
        dataBound: autoSeleccionar,
        dataSource: {
            error: mostrarErrorDataSource,
            serverFiltering: true,
            transport: { read: url + 'empresa/obtenerPorSesion' }
        },
        dataTextField: 'nomemp',
        dataValueField: 'codemp',
        optionLabel: 'Seleccione empresa...'
    }).data('kendoDropDownList');
    
    var localidad = $('#inputLocal').kendoDropDownList({
        autoBind: false,
        cascadeFrom: 'inputEmpresa',
        change: function() {
            $('#btnLoginIngresar').removeAttr('disabled');
        },
        dataBound: autoSeleccionar,
        dataSource: {
            error: mostrarErrorDataSource,
            serverFiltering: true,
            transport: { read: url + 'localidad/obtenerPorEmpresa' }
        },
        dataTextField: 'nomloc',
        dataValueField: 'codloc',
        optionLabel: 'Seleccione localidad...'
    }).data('kendoDropDownList');
    
    $('#frmEmpresa').on('submit', function(evento) {
        evento.preventDefault();
        $('#btnLoginIngresar').button('loading');
        
        $.post(url + 'empresa/recordar', { 
            codemp: empresa.value(), 
            codloc: localidad.value()
        }).done(function(datos, estado, peticion) {
            location.href = url + 'dashboard';
        }).fail(mostrarErrorAjax).always(function() {
            $('#btnLoginIngresar').button('reset');
        });
    });
}

function autoSeleccionar() {
    if (this.dataSource.total() === 1) {
        this.select(1);
        this.trigger('change');
    }
}
