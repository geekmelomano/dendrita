<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="login-content" data-ng-app="mycofiApp">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Jonathan Muñoz Aleman - geek.melomano@gmail.com">
        <title>MyCofi - Inicio de Sesión</title>
        
        <link rel="icon" href="favicon.ico">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css">

        <!-- CSS -->
        <link rel="stylesheet" href="css/app.min.1.css">
        <link rel="stylesheet" href="css/app.min.2.css">
        
        <style>
            body.login-content:before { background: #464646; }
            header { margin-top: 100px; position: relative; }
            .lc-block { margin-top: 25px; }
        </style>
    </head>

    <body class="login-content" data-ng-controller="LoginCtrl as login">
        <header class="text-center">
            <img src="img/logo.png" alt="Logo de IMedia">
        </header>

        <!-- Formulario de inicio de sesion -->
        <form id="l-login" class="lc-block" role="form" data-ng-class="{ 'toggled': !login.logueado }" data-ng-if="!login.logueado"
                data-ng-submit="login.iniciarSesion()">
            <fieldset>
                <legend>Por favor, inicia sesión</legend>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                    <div class="fg-line" data-ng-class="login.claseUsuario" 
                            data-ng-class="{ 'has-feedback': lctrl.claseUsuario !== '' }">
                        <input type="text" class="form-control" placeholder="Nombre de usuario" required autofocus
                                data-ng-model="login.username" data-ng-blur="login.validarUsuario()">
                        <span class="zmdi form-control-feedback" data-ng-class="login.iconoUsuario"></span>
                    </div>
                    <div class="text-left" data-ng-class="login.claseUsuario">
                        <small class="help-block">{{ login.mensajeUsuario }}</small>
                    </div>
                </div>

                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>
                    <div class="fg-line">
                        <input type="password" class="form-control" placeholder="Contraseña" required 
                               data-ng-model="login.password">
                    </div>
                </div>

                <button type="submit" class="btn btn-login btn-primary btn-float" 
                        data-ng-hide="login.username === '' || login.password === '' || login.claseUsuario !== 'has-success'">
                    <i class="zmdi zmdi-arrow-forward"></i></button>
            </fieldset>
        </form>

        <!-- Formulario de seleccion de sistema, empresa y localidad -->
        <form id="l-register" class="form-horizontal lc-block" role="form" 
                data-ng-class="{ 'toggled': login.logueado }" data-ng-if="login.logueado">
            <fieldset>           
                <legend>Hola, {{ login.nombreUsuario }}.<br>Por favor, {{ login.paso }}</legend>
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Sistema:</label>
                    <div class="col-sm-9">
                        <div class="fg-line">
                            <div class="select">
                                <select class="form-control" data-ng-change="login.listarEmpresas()" 
                                        data-ng-model="login.sistema" 
                                        data-ng-options="sist.nomsis for sist in login.sistemas"></select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" data-ng-hide="!login.sistema">
                    <label for="" class="col-sm-3 control-label">Empresa:</label>
                    <div class="col-sm-9">
                        <div class="fg-line">
                            <div class="select">
                                <select class="form-control" data-ng-change="login.listarLocalidades()" 
                                        data-ng-model="login.empresa" 
                                        data-ng-options="empr.nomemp for empr in login.empresas"></select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" data-ng-hide="!login.empresa">
                    <label for="" class="col-sm-3 control-label">Localidad:</label>
                    <div class="col-sm-9">
                        <div class="fg-line">
                            <div class="select">
                                <select class="form-control" data-ng-model="login.localidad" 
                                        data-ng-options="local.nomloc for local in login.localidades"></select>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-login btn-primary btn-float" data-ng-hide="!login.localidad">
                    <i class="zmdi zmdi-arrow-forward"></i></button>
            </fieldset>

            <ul class="login-navigation">
                <li class="bgm-bluegray" data-block="#l-login" data-ng-click="login.irAAdmin()" 
                        data-ng-hide="!login.esAdministrador">Administración</li>
                <li class="bgm-red" data-block="#l-login" data-ng-click="login.cerrarSesion()">Cerrar sesión</li>
            </ul>
        </form>

        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->

        <!-- Core -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Angular -->
        <script src="vendors/bower_components/angular/angular.min.js"></script>
        <script src="vendors/bower_components/angular-animate/angular-animate.min.js"></script>
        <script src="vendors/bower_components/angular-resource/angular-resource.min.js"></script>

        <!-- Common Vendors -->
        <script src="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="vendors/bootstrap-growl/bootstrap-growl.min.js"></script>

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
                
        <!-- App level -->
        <script src="js/login.js"></script>
        <script src="js/controllers/login.js"></script>
        <script src="js/services.js"></script>
        <script src="js/services/login.js"></script>

        <!-- Template Modules -->
        <script src="js/modules.js"></script>
    </body>
</html>
