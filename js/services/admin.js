
mycofiApp.service('grupoEmpresaService', ['$resource', function($resource) {
    this.leer = function() {
        var GruposEmpresa = $resource('/mycofi/grupoempresa/obtener');
        return GruposEmpresa.query().$promise;
    };
}]);

mycofiApp.service('empresaService', ['$resource', function($resource) {
    this.leer = function() {
        var Empresa = $resource('/mycofi/empresa/obtener');
        return Empresa.query().$promise;
    };
}]);
