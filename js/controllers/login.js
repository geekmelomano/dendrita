
//=================================================
// LOGIN
//=================================================

mycofiApp.controller('LoginCtrl', [
    '$window',
    'growlService', 
    'usuarioService', 
    'sesionService', 
    LoginCtrl
]);

function LoginCtrl($window, growlService, usuarioService, sesionService) {
    var vm = this;
    vm.logueado = false;
    vm.username = '';
    vm.password = '';

    vm.claseUsuario = '';
    vm.iconoUsuario = '';
    vm.mensajeUsuario = '';
    vm.nombreUsuario = '';

    vm.validarUsuario = function() {
        if (typeof vm.username === 'undefined' || vm.username === '')
            vm.mostrarValidacion('', '', '');
        else {
            usuarioService.validar(vm.username).then(function(respuesta) {
                var icono = (respuesta.data.estado === 'success' ? 'check' : 'alert-triangle');
                vm.mostrarValidacion('has-' + respuesta.data.estado, 'zmdi-' + icono, respuesta.data.mensaje);
            }, function(respuesta) {
                vm.mostrarError('Ha ocurrido un error al intentar validar al usuario.', respuesta);
                vm.mostrarValidacion('has-error', 'zmdi-close', 
                        'Error ' + respuesta.status + ' - ' + respuesta.statusText);
            });
        }
    };

    vm.mostrarValidacion = function(clase, icono, mensaje) {
        vm.claseUsuario = clase;
        vm.iconoUsuario = icono;
        vm.mensajeUsuario = mensaje;
    };
    
    vm.iniciarSesion = function() {
        usuarioService.autenticar(vm.username, vm.password).then(function(respuesta) {
            vm.logueado = (respuesta.data.estado === 'success');
            
            if (vm.logueado) {
                localStorage.setItem('coduser', respuesta.data.usuario.cod_usuario);
                localStorage.setItem('nomuser', respuesta.data.usuario.nom_usuario);
                localStorage.setItem('tipo_usuario', respuesta.data.usuario.tipo_usuario);
                $window.location.href = 'http://localhost/mycofi';
            } else growlService.growl(respuesta.data.mensaje, respuesta.data.estado);
        }, function(respuesta) {
            vm.mostrarError('Ha ocurrido un error al intentar iniciar la sesión.', respuesta);
        });
    };
    
    vm.cerrarSesion = function() {
        swal({   
            title: "CERRAR SESION",
            text: "Realmente está seguro de cerrar la sesión?",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sí, ciérrala!",   
            cancelButtonText: "No, cancela por favor!"
        }, function(isConfirm){
            if (isConfirm) {
                sesionService.cerrar().then(function(respuesta) {
                    vm.mostrarValidacion('', '', '');
                    vm.logueado = false;
                    localStorage.clear();
                }, function(respuesta) {
                    vm.mostrarError('Ha ocurrido un error al intentar cerrar la sesión.', respuesta);
                });
            }
        });
    };
    
    vm.mostrarError = function(mensaje, respuesta) {
        growlService.growl(mensaje + '<br>Error ' + respuesta.status + ' - ' + respuesta.statusText, 'danger');
    };

}
