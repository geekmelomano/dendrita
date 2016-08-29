
var url = '/mycofi/';
var notificacion;

function iniciarNotificador() {
    notificacion = $('#notificacion').kendoNotification({
        appendTo: '#areaNotificacion'
    }).data('kendoNotification');
}

function mostrarError(error, estado, peticion) {
    notificacion.error('Ha ocurrido un error al intentar una peticion al servidor:<br>' 
            + error + '<br><a href="#" class="errorLink">Más información</a>');

    $('.errorLink').on('click', function(e) {
        e.preventDefault();
        $('#errorLabel').html(estado);
        $('#errorBody').html(peticion.responseText);
        $('#errorModal').modal('show');
        return false;
    });
}

function mostrarErrorAjax(peticion, estado, error) {
    mostrarError(error, estado, peticion);
}

function mostrarErrorDataSource(evento) {
    mostrarError(evento.errorThrown, evento.status, evento.xhr);
}
