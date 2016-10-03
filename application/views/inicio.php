<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9 login-content" data-ng-app="mycofiApp" data-ng-controller="InicioCtrl as inicio"><![endif]-->
<html class="login-content" data-ng-app="mycofiApp" data-ng-controller="InicioCtrl as inicio">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Jonathan Muñoz Aleman - geek.melomano@gmail.com">
        <title>MyCofi - Inicio</title>
        
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
            header { margin-top: 100px; }
        </style>
    </head>

    <body class="login-content">
        <header></header>
        
        <form class="form-horizontal lc-block lcb-alt toggled" id="l-lockscreen">
            <img class="lcb-user" data-ng-src="img/profile-pics/{{ inicio.codUser }}.jpg" 
                    alt="Avatar de {{ inicio.codUser }}">
            
            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Sistema:</label>
                <div class="col-sm-9">
                    <div class="fg-line">
                        <div class="select">
                            <select class="form-control" data-ng-change="inicio.listarEmpresas()" 
                                    data-ng-model="inicio.sistema" 
                                    data-ng-options="sist.nomsis for sist in inicio.sistemas"></select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group" data-ng-hide="!inicio.sistema">
                <label for="" class="col-sm-3 control-label">Empresa:</label>
                <div class="col-sm-9">
                    <div class="fg-line">
                        <div class="select">
                            <select class="form-control" data-ng-change="inicio.listarLocalidades()" 
                                    data-ng-model="inicio.empresa" 
                                    data-ng-options="empr.nomemp for empr in inicio.empresas"></select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group" data-ng-hide="!inicio.empresa">
                <label for="" class="col-sm-3 control-label">Localidad:</label>
                <div class="col-sm-9">
                    <div class="fg-line">
                        <div class="select">
                            <select class="form-control" data-ng-model="inicio.localidad" 
                                    data-ng-options="local.nomloc for local in inicio.localidades"></select>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-login btn-primary btn-float" data-ng-hide="!inicio.localidad">
                <i class="zmdi zmdi-arrow-forward"></i></button>

            <ul class="login-navigation">
                <li class="bgm-bluegray" data-block="#l-register" data-ng-click="inicio.irAAdmin()" 
                        data-ng-hide="!inicio.esAdmin">Administración</li>
                <li class="bgm-red" data-block="#l-register" data-ng-click="inicio.irALogin()">
                    No eres {{ inicio.nomUser }}?</li>
            </ul>
        </form>
        
        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Advertencia!!</h1>
                <p>Usted está utilizando una versión antigua de Internet Explorer, por favor, actualice<br>
                    a cualquier de los siguientes navegadores web para acceder a esta aplicación web.</p>
        
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="Chrome">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="Firefox">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="Opera">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="Safari">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="IE (Nuevo)">
                                <div>IE (Nuevo)</div>
                            </a>
                        </li>
                    </ul>
                </div>
        
                <p>¡Lo sentimos por los inconvenientes ocasionados!</p>
            </div>
        <![endif]-->

        <!-- Core -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Angular -->
        <script src="vendors/bower_components/angular/angular.min.js"></script>
        <script src="vendors/bower_components/angular-animate/angular-animate.min.js"></script>
        <script src="vendors/bower_components/angular-resource/angular-resource.min.js"></script>
        
        <!-- Angular Modules -->
        <!--<script src="vendors/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>-->
        <!--<script src="vendors/bower_components/angular-loading-bar/src/loading-bar.js"></script>-->
        <!--<script src="vendors/bower_components/oclazyload/dist/ocLazyLoad.min.js"></script>-->
        <!--<script src="vendors/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>-->

        <!-- Common Vendors -->
        <script src="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <!--<script src="vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js"></script>-->
        <!--<script src="vendors/bower_components/Waves/dist/waves.min.js"></script>-->
        <!--<script src="vendors/bower_components/angular-nouislider/src/nouislider.min.js"></script>-->
        <!--<script src="vendors/bower_components/ng-table/dist/ng-table.min.js"></script>-->
        
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->
        
        <!-- App level -->
        <script src="js/inicio.js"></script>
        <script src="js/controllers/inicio.js"></script>
        <script src="js/services.js"></script>
        <script src="js/services/inicio.js"></script>

        <!-- Template Modules -->
        <script src="js/modules.js"></script>
    </body>
</html>
