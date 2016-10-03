
var mycofiApp = angular.module('mycofiApp', [
    'ngAnimate', 
    'ngResource', 
    'ui.router', 
    'ui.bootstrap',
    'oc.lazyLoad', 
    'ngTable'
]);

mycofiApp.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/inicio');
    
    //------------------------------
    // INICIO
    //------------------------------
    
    $stateProvider.state('inicio', {
        url: '/inicio',
        templateUrl: 'views/admin/inicio.html'
    });
    
    $stateProvider.state('gruposempresas', {
        url: '/gruposempresas',
        templateUrl: 'views/admin/gruposempresas.html',
        controller: 'GrupoEmpresaCtrl as grupo'
    });
    
    $stateProvider.state('empresas', {
        url: '/empresas',
        templateUrl: 'views/admin/empresas.html',
        controller: 'EmpresaCtrl as empresa'
    });
    
    $stateProvider.state('nuevaempresa', {
        url: '/nuevaempresa',
        templateUrl: 'views/admin/empresa-form.html',
        controller: 'EmpresaCtrl as empresa',
        resolve: {
            loadPlugin: function($ocLazyLoad) {
                return $ocLazyLoad.load([
                    {
                        name: 'vendors',
                        files: [ 'vendors/input-mask/input-mask.min.js' ]
                    }
                ]);
            }
        }
    });
    
});
