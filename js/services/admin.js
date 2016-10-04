
mycofiApp.service('grupoEmpresaService', ['$resource', function($resource) {
    this.leer = function() {
        var GruposEmpresa = $resource('/mycofi/grupoempresa/obtener');
        return GruposEmpresa.query().$promise;
    };
}]);

mycofiApp.service('empresaService', ['$resource', function($resource) {
    this.crear = function(datos) {
        var Empresa = $resource('/mycofi/empresa/crear');
        return Empresa.save(datos).$promise;
    };
        
    this.leer = function() {
        var Empresa = $resource('/mycofi/empresa/obtener');
        return Empresa.query().$promise;
    };
}]);

mycofiApp.service('localidadService', ['$resource', function($resource) {
    this.leer = function() {
        var Localidades = $resource('/mycofi/localidad/obtener');
        return Localidades.query().$promise;
    };
}]);
