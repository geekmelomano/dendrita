
// =========================================================================
// INPUT FIELDS MODIFICATION
// =========================================================================

//Add blue animated border and remove with condition when focus and blur

mycofiApp.directive('fgLine', function() {
    return {
        restrict: 'C',
        link: function(scope, element) {
            if($('.fg-line')[0]) {
                $('body').on('focus', '.form-control', function() {
                    $(this).closest('.fg-line').addClass('fg-toggled');
                });

                $('body').on('blur', '.form-control', function() {
                    var p = $(this).closest('.form-group');
                    var i = p.find('.form-control').val();

                    if (p.hasClass('fg-float')) {
                        if (i.length === 0)
                            $(this).closest('.fg-line').removeClass('fg-toggled');
                    } else $(this).closest('.fg-line').removeClass('fg-toggled');
                });
            }
        }
    };
});

// =========================================================================
// LAYOUT
// =========================================================================

mycofiApp.directive('changeLayout', function() {
    return {
        restrict: 'A',
        scope: { changeLayout: '=' },
        link: function(scope, element, attr) {
            //Default State
            if(scope.changeLayout === '1') element.prop('checked', true);

            //Change State
            element.on('change', function() {
                if (element.is(':checked')) {
                    localStorage.setItem('ma-layout-status', 1);
                    
                    scope.$apply(function() {
                        scope.changeLayout = '1';
                    });
                } else {
                    localStorage.setItem('ma-layout-status', 0);
                    
                    scope.$apply(function(){
                        scope.changeLayout = '0';
                    });
                }
            });
        }
    };
});

// =========================================================================
// MAINMENU COLLAPSE
// =========================================================================

mycofiApp.directive('toggleSidebar', function() {
    return {
        restrict: 'A',
        scope: { modelLeft: '=', modelRight: '=' },
        link: function(scope, element, attr) {
            element.on('click', function() {
                if (element.data('target') === 'mainmenu') {
                    if (scope.modelLeft === false)
                        scope.$apply(function() {
                            scope.modelLeft = true;
                        });
                    else 
                        scope.$apply(function() {
                            scope.modelLeft = false;
                        });
                }

                if (element.data('target') === 'chat') {
                    if (scope.modelRight === false)
                        scope.$apply(function() {
                            scope.modelRight = true;
                        });
                    else 
                        scope.$apply(function() {
                            scope.modelRight = false;
                        });
                }
            });
        }
    };
});

// =========================================================================
// SUBMENU TOGGLE
// =========================================================================

mycofiApp.directive('toggleSubmenu', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            element.click(function(){
                element.next().slideToggle(200);
                element.parent().toggleClass('toggled');
            });
        }
    };
});
