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
        <link rel="icon" href="favicon.ico">

        <title>Configuración</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link rel="stylesheet" href="css/ie10-viewport-bug-workaround.css">
        
        <link rel="stylesheet" href="css/kendo.common.min.css">
        <link rel="stylesheet" href="css/kendo.bootstrap.min.css">
        <link rel="stylesheet" href="css/kendo.bootstrap.mobile.min.css">

        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/dashboard.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="errorLabel"></h4>
                    </div>
                    <div id="errorBody" class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="notificacion"></div>
        
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">MyCOFI</a>
                </div>
                
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="#">Perfil</a></li>
                        <li><a href="#">Ayuda</a></li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Buscar...">
                    </form>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active">
                            <a href="configuracion/confempresas">Empresas y Localidades</a></li>
                        <li><a href="sistema">Gestión de Sistemas</a></li>
                        <li><a href="configuracion/confperfiles">Perfiles y Reglas de Acceso</a></li>
                        <li><a href="configuracion/confusuarios">Gestión de Usuarios</a></li>
                    </ul>
                </div>
                
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"></div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>');</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="js/vendor/ie10-viewport-bug-workaround.js"></script>
        
        <script src="js/vendor/jszip.min.js"></script>
        <script src="js/vendor/kendo.all.min.js"></script>
        <script src="js/vendor/kendo.culture.es-PE.min.js"></script>
        <script src="js/vendor/kendo.messages.es-PE.js"></script>
        
        <script src="js/main.js"></script>
        <script src="js/configuracion.js"></script>
    </body>
</html>
