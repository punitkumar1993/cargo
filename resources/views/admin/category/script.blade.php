<script>
    "use strict";

    $(document).on("click", "#btn-reset", function(e) {
        $(".card-form.card-title").html("Add New Category");
        $("form#insert").removeAttr("href");
        $("#name").val("");

        $("#name").removeClass("is-invalid");
        $(".msg-error-name").html("");

        $("#categories").val(null).trigger("change")
        $("#btn-reset").attr("hidden", true)

        $("button[type=submit]").attr("id", "btn-submit").html("Add New Category");
    });

    $(document).on("click", "#btn-submit-update", function(e) {
        e.preventDefault();
        $("#update button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");
        $("#name").removeClass("is-invalid");
        $(".msg-error-name").html("");

        let editurl = $("form#insert").attr("href");
        $.ajax({
            url: editurl,
            method: 'PUT',
            data: $("#insert").serialize(),
            success: function(response) {
                if (response.errors) {
                    if (response.errors.name) {
                        $("#name").addClass("is-invalid")
                        $("#insert button[type=submit]").html("Resending");
                        $(".msg-error-name").html(response.errors.name);
                    }
                } else {
                    $(".spinner-grow").attr("hidden");
                    toastr.success(response.success);
                    $("#category-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
					$("textarea").val("");
                    $("#categories").val(null).trigger("change");
                    $("#insert button[type=submit]").html("Add New Category");
                    $("#update").attr("id", "insert");
                    $("#btn-reset").attr("hidden", true);
                }
            }
        });
    });

    $(document).on("click", "#btn-submit", function(e) {
        e.preventDefault();
        $("#insert button[type=submit]").html("<div class=\"spinner-grow spinner-grow-sm\" role=\"status\"><span class=\"sr-only\">Loading...</span></div> Sending...");
        $("#name").removeClass("is-invalid")
        $(".msg-error-name").html("");

        $.ajax({
            url: "{{ route('categories.store') }}",
            method: 'POST',
            data: $("#insert").serialize(),
            success: function(response) {
                if (response.errors) {
                    if (response.errors.name) {
                        $("#name").addClass("is-invalid")
                        $("#insert button[type=submit]").html("Resending");
                        $(".msg-error-name").html(response.errors.name);
                        $("#btn-reset").removeAttr("hidden");
                    }
                } else if (response.error_exists) {
                    $("#name").addClass("is-invalid");
                    $("#insert button[type=submit]").html("Resending");
                    $(".msg-error-name").html(response.error_exists);
                    $("#btn-reset").removeAttr("hidden");
                } else {
                    $(".spinner-grow").attr("hidden");
                    toastr.success(response.success);
                    $("#category-table").DataTable().ajax.reload();
                    $("input[type=text]").val("");
                    $("#insert button[type=submit]").html("Add New Category");
                }
            }
        });
    });
</script>
