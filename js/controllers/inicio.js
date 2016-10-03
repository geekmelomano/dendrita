
mycofiApp.controller('InicioCtrl', [
    '$window',
    'growlService', 
    'sistemaService', 
    'empresaService',
    'localidadService',
    InicioCtrl
]);

function InicioCtrl($window, growlService, sistemaService, empresaService, localidadService) {
    var vm = this;
    vm.codUser = localStorage.getItem('coduser');
    vm.nomUser = localStorage.getItem('nomuser');
    vm.esAdmin = (localStorage.getItem('tipo_usuario') === '99');
    
    vm.sistemas = [];
    vm.sistema = false;
    
    vm.empresas = [];
    vm.empresa = false;
    
    vm.localidades = [];
    vm.localidad = false;
    
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
    };
    
    vm.listarLocalidades = function() {
        localidadService.listar(vm.sistema.codsis, vm.empresa.codemp).then(function(respuesta) {
            vm.localidades = respuesta;
            
            if (vm.localidades.length === 1) {
                vm.localidad = vm.localidades[0];
            }
        }, function(respuesta) {
            vm.mostrarError('Ha ocurrido un error al intentar obtener la lista de localidades.', respuesta);
        });
    };
    
    vm.mostrarError = function(mensaje, respuesta) {
        growlService.growl(mensaje + '<br>Error ' + respuesta.status + ' - ' + respuesta.statusText, 'danger');
    };
    
    vm.irAAdmin = function() {
        $window.location.href = 'http://localhost/mycofi/admin';
    };
    
    vm.irALogin = function() {
        $window.location.href = 'http://localhost/mycofi/login';
    };
    
    vm.listarSistemas();
    
}
