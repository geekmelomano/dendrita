
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
