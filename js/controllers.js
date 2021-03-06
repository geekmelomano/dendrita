
// =========================================================================
// Base controller for common functions
// =========================================================================

mycofiApp.controller('DashboardCtrl', ['$state', '$timeout', function($state, $timeout) {
    // Detact Mobile Browser
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        angular.element('html').addClass('ismobile');
    }

    // By default Sidebars are hidden in boxed layout and in wide layout only the right sidebar is hidden.
    this.sidebarToggle = {
        left: false,
        right: false
    };

    // By default template has a boxed layout
    this.layoutType = localStorage.getItem('ma-layout-status');

    // For Mainmenu Active Class
    this.$state = $state;    

    //Close sidebar on click
    this.sidebarStat = function(event) {
        if (!angular.element(event.target).parent().hasClass('active')) {
            this.sidebarToggle.left = false;
        }
    };

    //Listview Search (Check listview pages)
    this.listviewSearchStat = false;

    this.lvSearch = function() {
        this.listviewSearchStat = true; 
    };

    //Listview menu toggle in small screens
    this.lvMenuStat = false;

    //Blog
    this.wallCommenting = [];

    this.wallImage = false;
    this.wallVideo = false;
    this.wallLink = false;

    //Skin Switch
    this.currentSkin = 'blue';

    this.skinList = [ 
        'lightblue', 'bluegray', 'cyan', 'teal', 'green', 'orange', 'blue', 'purple' 
    ];

    this.skinSwitch = function (color) {
        this.currentSkin = color;
    };
    
    this.coduser = localStorage.getItem('coduser');
    this.nomuser = localStorage.getItem('nomuser');
    
    this.mostrarEdicion = function(maestro, detalle) {
        angular.element('#' + maestro).addClass('fadeOut');
        
        $timeout(function() {
            angular.element('#' + maestro).addClass('hidden');
            angular.element('#' + detalle).removeClass('hidden');
            angular.element('#' + detalle).addClass('fadeIn');
        }, 1200);
    };
}]);

// =========================================================================
// Header
// =========================================================================
mycofiApp.controller('HeaderCtrl', function($timeout, $window/*, messageService*/) {
    
    // Top Search
    this.openSearch = function() {
        angular.element('#header').addClass('search-toggled');
        angular.element('#top-search-wrap').find('input').focus();
    };

    this.closeSearch = function() {
        angular.element('#header').removeClass('search-toggled');
    };

    // Get messages and notification for header
//    this.img = messageService.img;
//    this.user = messageService.user;
//    this.user = messageService.text;
//    this.messageResult = messageService.getMessage(this.img, this.user, this.text);

    //Clear Notification
    this.clearNotification = function($event) {
        $event.preventDefault();

        var x = angular.element($event.target).closest('.listview');
        var y = x.find('.lv-item');
        var z = y.size();

        angular.element($event.target).parent().fadeOut();

        x.find('.list-group').prepend('<i class="grid-loading hide-it"></i>');
        x.find('.grid-loading').fadeIn(1500);
        var w = 0;

        y.each(function() {
            var z = $(this);
            
            $timeout(function() {
                z.addClass('animated fadeOutRightBig').delay(1000).queue(function() {
                    z.remove();
                });
            }, w += 150);
        });

        $timeout(function() {
            angular.element('#notifications').addClass('empty');
        }, (z * 150) + 200);
    };
    
    this.irAInicio = function() {
        $window.location.href = 'http://localhost/mycofi';
    };

    //Fullscreen View
    this.fullScreen = function() {
        //Launch
        function launchIntoFullscreen(element) {
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if(element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if(element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if(element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        }

        //Exit
        function exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if(document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if(document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }

        if (exitFullscreen()) launchIntoFullscreen(document.documentElement);
        else launchIntoFullscreen(document.documentElement);
    };

});
