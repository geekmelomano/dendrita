
mycofiApp.controller('GrupoEmpresaCtrl', ['NgTableParams', 'grupoEmpresaService', GrupoEmpresaCtrl]);
mycofiApp.controller('EmpresaCtrl', ['NgTableParams', 'empresaService', 'grupoEmpresaService', EmpresaCtrl]);

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

function EmpresaCtrl(NgTableParams, empresaService, grupoEmpresaService) {
    var vm = this;
    
    vm.estados = [ 
        { id: 'S', title: 'ACTIVO'}, { id: 'C', title: 'CERRADO' } 
    ];
    
    vm.lista = new NgTableParams({ count: 10, page: 1 }, {
        getData: function(params) {
            return empresaService.leer().then(function(datos) {
                params.total(datos.length);
                return datos;
            });
        }
    });
    
    vm.instancia = {
        codemp: '',
        codgru: null,
        nomemp: '',
        dirfis: '',
        dirleg: '',
        ubigeo: '',
        ruc: '',
        telefono: '',
        fax: '',
        email: '',
        pagweb: '',
        reg_patronal: '',
        giro_negocio: '',
        tipo_negocio: '',
        nom_representante: '',
        dni_representante: '',
        estado: vm.estados[0],
        usuario: localStorage.getItem('coduser'),
        fechamodificacion: new Date()
    };
    
    vm.grupos = [];
    
    grupoEmpresaService.leer().then(function(datos) {
        vm.grupos = datos;
    });
    
    vm.inicializar = function() {
        vm.instancia.codemp = '';
        vm.instancia.codgru = null;
        vm.instancia.nomemp = '';
        vm.instancia.dirfis = '';
        vm.instancia.dirleg = '';
        vm.instancia.ubigeo = '';
        vm.instancia.ruc = '';
        vm.instancia.telefono = '';
        vm.instancia.fax = '';
        vm.instancia.email = '';
        vm.instancia.pagweb = '';
        vm.instancia.reg_patronal = '';
        vm.instancia.giro_negocio = '';
        vm.instancia.tipo_negocio = '';
        vm.instancia.nom_representante = '';
        vm.instancia.dni_representante = '';
        vm.instancia.estado = vm.estados[0];
        vm.instancia.usuario = localStorage.getItem('coduser');
        vm.instancia.fechamodificacion = new Date();
    };
    
    vm.guardar = function() {
        empresaService.crear(vm.instancia).then(function(datos) {
            console.log(datos);
        });
    };
    
}
