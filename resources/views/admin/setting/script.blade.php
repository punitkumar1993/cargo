<script>
    "use strict";

    $(function() {
        bsCustomFileInput.init()
    });

    let editor = CodeMirror.fromTextArea(document.getElementById("credit_footer"), {
        mode: "htmlmixed",
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true
    });
    editor.setSize(null, 100);
    editor.on('change', (editor) => {
        const text = editor.doc.getValue()
        console.log(text);
        $('#credit_footer').html(text);
    });


    $(document).on("click", "#submit-web-properties", function(e) {
        e.preventDefault();
        $("#submit-web-properties").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");
        $.ajax({
            url: "{{ route('settings.update') }}",
            method: "POST",
            data: $("#form-web-information").serialize(),
            success: function(response) {
                if (response.errors) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#submit-web-properties").html("Save");
                    toastr.error(response.errors);
                } else if (response.info) {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.info(response.info);
                    $("#submit-web-properties").html("Save");
                } else {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.success(response.success);
                    $("#submit-web-properties").html("Save");
                }
            }
        });
    });

    $(document).on("click", "#submit-web-contact", function(e) {
        e.preventDefault();
        $("#submit-web-contact").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");
        $.ajax({
            url: "{{ route('settings.update') }}",
            method: "POST",
            data: $("#form-web-contact").serialize(),
            success: function(response) {
                if (response.errors) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#submit-web-contact").html("Save");
                    toastr.error(response.errors);
                } else if (response.info) {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.info(response.info);
                    $("#submit-web-contact").html("Save");
                } else {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.success(response.success);
                    $("#submit-web-contact").html("Save");
                }
            }
        });
    });

    $(document).on("click", "#submit-web-config", function(e) {
        e.preventDefault();
        $("#submit-web-config").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");
        $.ajax({
            url: "{{ route('settings.update') }}",
            method: "POST",
            data: $("#form-web-config").serialize(),
            success: function(response) {
                if (response.errors) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#submit-web-config").html("Save");
                    toastr.error(response.errors);
                } else if (response.info) {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.info(response.info);
                    $("#submit-web-config").html("Save");
                } else {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.success(response.success);
                    $("#submit-web-config").html("Save");
                }
            }
        });
    });

    $(document).on("click", "#submit-web-permalinks", function(e) {
        e.preventDefault();
        $("#submit-web-permalinks").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");
        $.ajax({
            url: "{{ route('settings.update') }}",
            method: "POST",
            data: $("#form-web-permalinks").serialize(),
            success: function(response) {
                if (response.errors) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#submit-web-permalinks").html("Save");
                    toastr.error(response.errors);
                } else if (response.info) {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.info(response.info);
                    $("#submit-web-permalinks").html("Save");
                } else {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.success(response.success);
                    $("#submit-web-permalinks").html("Save");
                }
            }
        });
    });

    $(document).on("click", "#submit-newsletters", function(e) {
        e.preventDefault();
        $("#submit-newsletters").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");
        $.ajax({
            url: "{{ route('settings.update') }}",
            method: "POST",
            data: $("#form-newsletters").serialize(),
            success: function(response) {
                if (response.errors) {
                    $(".spinner-grow").attr("hidden", true);
                    $("#submit-newsletters").html("Save");
                    toastr.error(response.errors);
                } else if (response.info) {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.info(response.info);
                    $("#submit-newsletters").html("Save");
                } else {
                    $(".spinner-grow").attr("hidden", true);
                    toastr.success(response.success);
                    $("#submit-newsletters").html("Save");
                }
            }
        });
    });

    $(document).on("change", "#customSwitch1", function(e) {
        let active = $(this).prop("checked") == true ? "y" : "n";
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/changeStatusMaintenance",
            data: {
                "active": active
            },
            success: function(data) {
                if(data.info) {
                    toastr.info(data.info);
                } else {
                    toastr.success(data.success);
                }
            }
        })
    });

    $(document).on("change", "#customSwitch2", function(e) {
        let active = $(this).prop("checked") == true ? "y" : "n";
        $.ajax({
            type: "PATCH",
            dataType: "json",
            url: "/changeRegisterMember",
            data: {
                "active": active
            },
            success: function(data) {
                if(data.info) {
                    toastr.info(data.info);
                } else if(data.success){
                    toastr.success(data.success);
                }else{
                    toastr.error(data.abort);
                }
            }
        })
    });

    $(document).ready(() => {
        let url = location.href.replace(/\/$/, "");

        if (location.hash) {
            const hash = url.split("#");
            $('#vert-tabs-tab a[href="#' + hash[1] + '"]').tab("show");
            url = location.href.replace(/\/#/, "#");
            history.replaceState(null, null, url);
            setTimeout(() => {
                $(window).scrollTop(0);
            }, 400);
        }

        $('a[data-toggle="pill"]').on("click", function() {
            let newUrl;
            const hash = $(this).attr("href");
            if (hash == "#web-properties") {
                newUrl = url.split("#")[0];
            } else {
                newUrl = url.split("#")[0] + hash;
            }
            newUrl += "/";
            history.replaceState(null, null, newUrl);
        });
    });
</script>
