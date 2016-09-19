
//=================================================
// LOGIN
//=================================================

mycofiApp.controller('LoginCtrl', [
    '$http',
    '$location',
    'growlService', 
    'usuarioService', 
    'sesionService', 
    'sistemaService', 
    'empresaService',
    'localidadService',
    LoginCtrl
]);

function LoginCtrl($http, $location, growlService, usuarioService, sesionService, 
        sistemaService, empresaService, localidadService) {
    var vm = this;
    vm.logueado = false;
    vm.username = '';
    vm.password = '';

    vm.claseUsuario = '';
    vm.iconoUsuario = '';
    vm.mensajeUsuario = '';
    vm.nombreUsuario = '';
    vm.esAdministrador = false;
    vm.paso = '';
    
    vm.sistemas = [];
    vm.sistema = false;
    
    vm.empresas = [];
    vm.empresa = false;
    
    vm.localidades = [];
    vm.localidad = false;

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
                vm.nombreUsuario = respuesta.data.usuario.nom_usuario;
                vm.esAdministrador = (respuesta.data.usuario.tipo_usuario === '99');
                vm.paso = 'selecciona un sistema';
                vm.listarSistemas();
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
                    vm.nombreUsuario = '';
                    vm.esAdministrador = false;
                    vm.paso = '';
                    vm.sistemas = [];
                    vm.sistema = false;
                    vm.empresas = [];
                    vm.empresa = false;
                    vm.localidades = [];
                    vm.localidad = false;
                }, function(respuesta) {
                    vm.mostrarError('Ha ocurrido un error al intentar cerrar la sesión.', respuesta);
                });
            }
        });
    };
    
    vm.listarSistemas = function() {
        sistemaService.listar().then(function(respuesta) {
            vm.sistemas = respuesta;
            
            if (vm.sistemas.length === 1) {
                vm.sistema = vm.sistemas[0];
                vm.listarEmpresas();
            }
        }, function(respuesta) {
            vm.mostrarError('Ha ocurrido un error al intentar obtener la lista de sistemas.', respuesta);
        });
    };
    
    vm.listarEmpresas = function() {
        empresaService.listar(vm.sistema.codsis).then(function(respuesta) {
            vm.empresas = respuesta;
            
            if (vm.empresas.length === 1) {
                vm.empresa = vm.empresas[0];
                vm.listarLocalidades();
            }
        }, function(respuesta) {
            vm.mostrarError('Ha ocurrido un error al intentar obtener la lista de empresas.', respuesta);
        });
        
        vm.paso = 'selecciona una empresa';
    };
    
    vm.listarLocalidades = function() {
        localidadService.listar(vm.sistema.codsis, vm.empresa.codemp).then(function(respuesta) {
            vm.localidades = respuesta;
            
            if (vm.localidades.length === 1) {
                vm.localidad = vm.localidades[0];
                vm.paso = 'pulsa el botón azul';
            }
        }, function(respuesta) {
            vm.mostrarError('Ha ocurrido un error al intentar obtener la lista de localidades.', respuesta);
        });
        
        vm.paso = 'selecciona una localidad';
    };
    
    vm.mostrarError = function(mensaje, respuesta) {
        growlService.growl(mensaje + '<br>Error ' + respuesta.status + ' - ' + respuesta.statusText, 'danger');
    };
    
    vm.irAAdmin = function() {
        $location.path('/mycofi/admin');
    };

}
