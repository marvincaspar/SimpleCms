$(document).ready(function () {
    $('body').addClass('sidebar-mini').addClass('skin-green');
});

function setAjaxHeader() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('.manage-contents > [name="_token"]').val()
        }
    });
}
