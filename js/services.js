
//==============================================
// BOOTSTRAP GROWL
//==============================================

mycofiApp.service('growlService', function() {
    var gs = {};
    
    gs.growl = function(message, type) {
        $.growl({
            message: message
        },{
            type: type,
            allow_dismiss: false,
            label: 'Cancel',
            className: 'btn-xs btn-inverse',
            placement: { from: 'bottom', align: 'right' },
            animate: { enter: 'animated bounceIn', exit: 'animated bounceOut' },
            offset: { x: 20, y: 85 }
        });
    };

    return gs;
});