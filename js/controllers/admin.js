
mycofiApp.controller('GrupoEmpresaCtrl', ['NgTableParams', 'grupoEmpresaService', GrupoEmpresaCtrl]);
mycofiApp.controller('EmpresaCtrl', ['NgTableParams', 'empresaService', EmpresaCtrl]);

function GrupoEmpresaCtrl(NgTableParams, grupoEmpresaService) {
    var vm = this;
    
    vm.lista = new NgTableParams({}, {
        getData: function(params) {
            return grupoEmpresaService.leer().then(function(datos) {
                console.log(datos);
                //params.total(datos.total);
                return datos.resultados;
            });
        }
    });
}

function EmpresaCtrl(NgTableParams, empresaService) {
    var vm = this;
    vm.estados = [ 
        { id: 'S', title: 'ACTIVO'}, { id: 'C', title: 'CERRADO' } ];
    
    vm.lista = new NgTableParams({ count: 10, page: 1 }, {
        getData: function(params) {
            return empresaService.leer().then(function(datos) {
                params.total(datos.length);
                return datos;
            });
        }
    });
}
