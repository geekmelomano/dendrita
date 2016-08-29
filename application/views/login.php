<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
    <head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<title>Inicio de Sesión</title>
        <meta name="author" content="Jonathan Muñoz Aleman - geek.melomano@gmail.com">
        <link rel="icon" href="favicon.ico">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/kendo.common.min.css">
        <link rel="stylesheet" href="css/kendo.bootstrap.min.css">
        <link rel="stylesheet" href="css/kendo.bootstrap.mobile.min.css">
        <link rel="stylesheet" href="css/login.css">
        
        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
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
        
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <span id="notificacion"></span>
                     
                    <main id="rootwizard">
                        <nav class="navbar">
                            <div class="navbar-inner">
                                <ul>
                                    <li><a href="#tabUsuario" data-toggle="tab">1. Inicio de Sesión</a></li>
                                    <li><a href="#tabSistema" data-toggle="tab">2. Selección de Sistema</a></li>
                                    <li><a href="#tabEmpresa" data-toggle="tab">3. Empresa y Localidad</a></li>
                                </ul>
                            </div>
                        </nav>

                        <div class="tab-content">
                            <section id="tabUsuario" class="tab-pane">
                                <form id="frmUsuario" class="form-signin">
                                    <h2 class="form-signin-heading">Por favor, inicie sesión</h2>
                                    
                                    <label for="inputUsuario" class="sr-only">Nombre de usuario</label>
                                    <div id="grupoUsuario" class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </div>
                                        <input type="text" id="inputUsuario" class="form-control" placeholder="Nombre de usuario" required autofocus>
                                    </div>
                                    
                                    <label for="inputClave" class="sr-only">Contraseña</label>
                                    <div id="grupoClave" class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-lock"></span>
                                        </div>
                                        <input type="password" id="inputClave" class="form-control" placeholder="Contraseña" required>
                                    </div>
                                    
                                    <button id="btnLoginContinuar" class="btn btn-lg btn-primary btn-block" 
                                            type="submit" data-loading-text="Iniciando sesión...">
                                        <span class="glyphicon glyphicon-log-in"></span> Continuar
                                    </button>
                                </form>
                            </section>

                            <section id="tabSistema" class="tab-pane">
                                <h2>A continuación, seleccione un sistema</h2>
                                <div id="listaSistemas"></div>
                            </section>

                            <section id="tabEmpresa" class="tab-pane">
                                <form id="frmEmpresa" class="form-horizontal">
                                    <h2 class="form-signin-heading">Finalmente, elija una empresa y local</h2>
                                    <div class="form-group">
                                        <label for="inputEmpresa" class="col-sm-2 control-label">Empresa:</label>
                                        <div class="col-sm-10">
                                            <input id="inputEmpresa" style="width:350px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputLocal" class="col-sm-2 control-label">Localidad:</label>
                                        <div class="col-sm-10">
                                            <input id="inputLocal" style="width:350px" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button id="btnLoginIngresar" type="submit" class="btn btn-lg btn-primary" 
                                                    disabled="true" data-loading-text="Cargando dashboard...">
                                                <span class="glyphicon glyphicon-ok"></span> Ingresar ahora
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </main>
                    
                    <div id="areaNotificacion"></div>
                </div>
            </div>
        </div>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>');</script>

        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/kendo.all.min.js"></script>
        <script src="js/vendor/jquery.bootstrap.wizard.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/login.js"></script>
        
        <script type="text/x-kendo-template" id="tmplSistema">
            <div class="sistema">
                <img src="img/sistemas/#: imagen #" alt="Imagen de #: nomsis #">
                <h3>#: nomsis #</h3>
            </div>
        </script>
    </body>
</html>
