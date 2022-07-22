<script>
    "use strict";
    
    $(document).on("click", "#btn-reset", function(e) {
        $(".card-form.card-title").html("Add New Social Media")
        $("#name").val("")
        $("#url").val("")
        $("#icon").val("")
        $("#btn-reset").attr("hidden", true)
        $("button[type=submit]").html("Add New Social Media")
    })

    $(document).on("click", "#btn-submit", function(e) {
        e.preventDefault();
        $("#insert button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");

        $("#name, #url, #icon").removeClass("is-invalid")
        $(".msg-error-name").html("");

        $.ajax({
            url: "{{ route('socialmedia.store') }}",
            method: 'POST',
            data: $("#insert").serialize(),
            success: function(response) {
                if (response.errors) {
                    if (response.errors.name) {
                        $("#name").addClass("is-invalid")
                        $("#insert button[type=submit]").html("Resending");
                        $(".msg-error-name").html(response.errors.name);
                    }
                    if (response.errors.url) {
                        $("#url").addClass("is-invalid")
                        $("#insert button[type=submit]").html("Resending");
                        $(".msg-error-url").html(response.errors.url);
                    }
                    if (response.errors.icon) {
                        $("#icon").addClass("is-invalid")
                        $("#insert button[type=submit]").html("Resending");
                        $(".msg-error-icon").html(response.errors.icon);
                    }
                } else {
                    $(".spinner-grow").attr("hidden");
                    toastr.success(response.success);
                    $("#socialmedia-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
                    $("#insert button[type=submit]").html("Add New Social Media");
                }

            }
        });
    })

    $(document).on("click", "#btn-submit-update", function(e) {
        e.preventDefault();
        $("#update button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");

        $.ajax({
            url: editurl,
            method: 'PUT',
            data: $("#insert").serialize(),
            success: function(response) {
                if (response.errors) {
                    if (response.errors.name) {
                        $("#name").addClass("is-invalid")
                        $("#url").addClass("is-invalid")
                        $("#icon").addClass("is-invalid")
                        $("#update button[type=submit]").html("Resending");
                        $(".msg-error-name").html(response.errors.name);
                    }
                } else {
                    $(".spinner-grow").attr("hidden");
                    toastr.success(response.success);
                    $("#socialmedia-table").DataTable().ajax.reload();
                    $("input[type=text], textarea").val("");
                    $("#insert button[type=submit]").html("Add New Social Media");
                    $("#update").attr("id", "insert");
                    $("#btn-reset").attr("hidden", true);
                }
            }
        });
    });
</script>