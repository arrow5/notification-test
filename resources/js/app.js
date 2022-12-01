require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function switcherUrl(swicherId,inputUrlId) {
    $(swicherId).change(function (){
        $(inputUrlId).toggleClass('hidden');
    });
}
switcherUrl('#olxActive','#olxActiveUrl');
switcherUrl('#fbActive','#fbActiveUrl');
switcherUrl('#idealitaActive','#idealitaActiveUrl');

$('.notification-delete').on('click',function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var destroyUrl = laroute.route('notifications.destroy',{notification:id});
    $('#confirm').attr('action',destroyUrl);
    //$('#modalConfirm').modal('show');
    const myModalAlternative = new bootstrap.Modal('#modalConfirm').show();
});
