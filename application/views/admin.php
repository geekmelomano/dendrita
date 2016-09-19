<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Jonathan Muñoz Aleman - geek.melomano@gmail.com">
        <title>MyCofi - Administración</title>
        <link rel="icon" href="favicon.ico">
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/kendo.common.min.css">
        <link rel="stylesheet" href="css/kendo.bootstrap.min.css">
        <link rel="stylesheet" href="css/kendo.bootstrap.mobile.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/Site.css">
        
        <script src="js/vendor/jquery-1.11.2.min.js"></script>
        <script src="js/vendor/angular.min.js"></script>
        <script src="js/vendor/angular-resource.min.js"></script>
        <script src="js/vendor/router.es5.min.js"></script>
        <script src="js/vendor/jszip.min.js"></script>
        <script src="js/vendor/kendo.all.min.js"></script>
        <script src="js/vendor/kendo.culture.es-PE.min.js"></script>
        <script src="js/vendor/kendo.messages.es-PE.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/mycofi.js"></script>
    </head>

    <body ng-app="mycofi" ng-controller="MyCofiController as mycofi">
        <div class="container-fluid">
            <div class="row row-offcanvas row-offcanvas-left">
                <div id="nav-section" class="col-xs-12 column">
                    <div class="navbar-default">
                        <button id="toggle-button" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <h1 id="dash-logo" class="center-block">MyCofi</h1>
                    <div id="sidebar-nav" class="collapse navbar-collapse" role="navigation">
                        <ul class="nav">
                            <li id="regional-sales-status">
                                <a ng-link="empresas">
                                    <span class="icon icon-chart-column"></span> Empresas y Localidades</a>
                            </li>
                        </ul>
                        <div id="rights">
                            <p>Copyright &copy; 2016, Jonathan Muñoz Aleman. Todos los derechos reservados.</p>
                        </div>
                    </div>
                </div>
                
                <div id="main-section" class="col-xs-12 column" ng-viewport></div>
            </div>
        </div>
        
        <script>
            $(window).resize(function() {
                kendo.resize('#main-section');
            });
        </script>
    </body>
</html>
