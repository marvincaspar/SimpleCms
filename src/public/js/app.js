function setAjaxHeader() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('.manage-contents > [name="_token"]').val()
        }
    });
}
