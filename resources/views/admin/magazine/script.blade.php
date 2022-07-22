<script>
    "use strict";

    $(document).on('click', '.upload-msg', function() {
        $("#upload").trigger("click");
    });

    const element = document.querySelector(".upload-banner");
    $('input[name=isimage]').val(element.classList.contains("ready"));

    $('#reset').on('click', function() {
        $('#display').removeAttr('hidden');
        $('#reset').attr('hidden');
        $('.upload-banner').removeClass('ready result');
        $('input[name=isimage]').val("false");
    });

    function readFile(input) {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('.upload-banner').addClass('ready');
            $('#image_preview_container').attr('src', e.target.result);
            $('input[name=isimage]').val("true");
        }
        reader.readAsDataURL(input.files[0]);
    }

    $('#upload').on('change', function() {
        readFile(this);
    });
</script>
