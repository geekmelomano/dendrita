<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9" data-ng-app="mycofiApp" data-ng-controller="DashboardCtrl as dashboard"><![endif]-->
<html data-ng-app="mycofiApp" data-ng-controller="DashboardCtrl as dashboard">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Jonathan Muñoz Aleman - geek.melomano@gmail.com">
        <title>MyCofi - Administración</title>
        
        <link rel="icon" href="favicon.ico">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css">
        <link rel="stylesheet" href="vendors/bower_components/angular-loading-bar/src/loading-bar.css">
        <link rel="stylesheet" href="vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css">

        <!-- CSS -->
        <link rel="stylesheet" href="css/app.min.1.css" id="app-level">
        <link rel="stylesheet" href="css/app.min.2.css">
    </head>

    <body data-ng-class="{ 'sw-toggled': dashboard.layoutType === '1'}">
        <data ui-view></data>

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
        
        <!-- Angular Modules -->
        <script src="vendors/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
        <script src="vendors/bower_components/angular-loading-bar/src/loading-bar.js"></script>
        <script src="vendors/bower_components/oclazyload/dist/ocLazyLoad.min.js"></script>
        <script src="vendors/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>

        <!-- Common Vendors -->
        <script src="vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="vendors/bower_components/ng-table/dist/ng-table.min.js"></script>       

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <!-- Using below vendors in order to avoid misloading on resolve -->
        <!--<script src="vendors/bower_components/flot/jquery.flot.js"></script>-->
        <!--<script src="vendors/bower_components/flot.curvedlines/curvedLines.js"></script>-->
        <!--<script src="vendors/bower_components/flot/jquery.flot.resize.js"></script>-->
        <!--<script src="vendors/bower_components/moment/min/moment.min.js"></script>-->
        <!--<script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>-->
        <!--<script src="vendors/bower_components/flot-orderBars/js/jquery.flot.orderBars.js"></script>-->
        <!--<script src="vendors/bower_components/flot/jquery.flot.pie.js"></script>-->
        <!--<script src="vendors/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>-->
        <!--<script src="vendors/bower_components/angular-nouislider/src/nouislider.min.js"></script>-->
        
        <!-- App level -->
        <script src="js/admin.js"></script>
        <script src="js/controllers.js"></script>
        <script src="js/controllers/admin.js"></script>
        <script src="js/services.js"></script>
        <script src="js/services/admin.js"></script>

        <!-- Template Modules -->
        <script src="js/modules.js"></script>
    </body>
</html>

