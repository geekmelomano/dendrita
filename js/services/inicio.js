
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
