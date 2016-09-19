
mycofiApp.service('usuarioService', ['$http', function($http) {
    this.validar = function(codusuario) {
        return $http.post('/mycofi/usuario/validar', { cod_usuario: codusuario });
    };
    
    this.autenticar = function(codusuario, contrasena) {
        return $http.post('/mycofi/usuario/autenticar', 
                { cod_usuario: codusuario, clave: contrasena });
    };
}]);

mycofiApp.service('sesionService', ['$http', function($http) {
    this.cerrar = function() {
        return $http.post('/mycofi/login/cerrarsesion');
    };
}]);

mycofiApp.service('sistemaService', ['$resource', function($resource) {
    this.listar = function() {
        var Sistemas = $resource('/mycofi/sistema/obtenerPorSesion');
        return Sistemas.query().$promise;
    };
}]);

mycofiApp.service('empresaService', ['$resource', function($resource) {
    this.listar = function(codsistema) {
        var Empresa = $resource('/mycofi/empresa/obtenerPorSistema', { codsis: codsistema });
        return Empresa.query().$promise;
    };
}]);

mycofiApp.service('localidadService', ['$resource', function($resource) {
    this.listar = function(codsistema, codempresa) {
        var Localidad = $resource('/mycofi/localidad/obtenerPorSistemaYEmpresa', 
                { codsis: codsistema, codemp: codempresa });
                
        return Localidad.query().$promise;
    };
}]);
