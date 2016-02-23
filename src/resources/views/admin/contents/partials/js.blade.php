<script src="{{ asset('simple-cms/js/admin/wysihtml/wysihtml-toolbar.js') }}"></script>
<script src="{{ asset('simple-cms/js/admin/wysihtml/parser_rules/advanced_and_extended.js') }}"></script>
<script src="{{ asset('simple-cms/js/admin/wysihtml.js') }}"></script>
<script src="{{ asset('simple-cms/js/admin/selectize.min.js') }}"></script>

<script type="text/javascript">
    /**
     * Init wysihtml editor
     */
    $('#content-textarea').wysihtml5();

    /**
     * Init select control
     */
    $('#select-link-to-content').selectize();

    $('input[type=radio]').change(function () {
        toogleFormElements();
    });

    function toogleFormElements() {
        if ($('#type-{{ \Mc388\SimpleCms\App\Models\Content::TYPE_LINK }}').is(":checked")) {
            $('#link-wrapper').show();
            $('#content-wrapper').hide();
        } else {
            $('#link-wrapper').hide();
            $('#content-wrapper').show();
        }
    }

    toogleFormElements();
</script>
