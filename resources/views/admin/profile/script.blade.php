<script>
    "use strict";

    @if(session('status'))
    let sessionId = "{{ uniqid() }}";
    if (sessionStorage) {
        if (!sessionStorage.getItem('shown-' + sessionId)) {
            Swal.fire({
            width: "22rem",
            title: "Success!",
            text: "{{session('status')}}",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
            })
        }
        sessionStorage.setItem('shown-' + sessionId, '1');
    }
    @endif

    $('select#role').select2({
        theme: 'bootstrap4',
        allowClear: true,
        placeholder: "Select Role..",
        selectOnClose: true,
        ajax: {
            url: "{{ route('roles.search') }}",
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        },
        createSearchChoice: function(item, data) {
            if ($(data).filter(function() {
                    return this.text.localeCompare(item) === 0;
                }).length === 0) {
                return {
                    id: item,
                    text: item
                }
            }
        }
    });

    function createInput(data) {
        $('.socmed').append('<div class="form-group row" id="socmed' + data.id + '"><label for="" class="col-sm-2 col-form-label"> URL ' + data.name + '</label><div class="col-sm-10"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"> <i class="' + data.icon + '"></i></span></div><input type="text" name="' + data.slug + '" class="form-control" placeholder="' + data.url + '"><div class="input-group-append" onclick="removeInput(' + data.id + ')"><span class="input-group-text" ><i class="fas fa-times"></i></span></div></div></div><input type="hidden" name="socmed[]" value="' + data.id + '"></div>');
    }

    function removeInput(id) {
        document.getElementById("socmed" + id).remove();
    }

    $("select#socialmedia").on('change', function() {
        let dataID = $('select#socialmedia').find(':selected').val() //get id;
        $.ajax({
            url: '/getsocmed',
            data: {
                'id': dataID
            },
            type: 'get',
            dataType: 'json',
            success: function(data) {
                if (!document.getElementById('socmed' + data.id)) {
                    createInput(data);
                }
            }
        })
    });

    $('select#socialmedia').select2({
        theme: 'bootstrap4',
        selectOnClose: true,
        ajax: {
            url: "{{ route('socialmedia.search') }}",
            processResults: function(data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        },
        createSearchChoice: function(item, data) {
            if ($(data).filter(function() {
                    return this.text.localeCompare(item) === 0;
                }).length === 0) {
                return {
                    id: item,
                    text: item
                }
            }
        }
    });
</script>
<script>
    $(function() {
        $('.upload-msg').on("click", function() {
            $('#btn-remove').attr('hidden', 'hidden');
            $('#btn-upload-result').removeAttr('hidden');
            $('#btn-upload-reset').removeAttr('hidden');
            $('#upload').trigger("click");
        })

        $('#btn-remove').on("click", function() {
            $.ajax({
                url: "{{ route('user.removePhoto') }}",
                type: 'DELETE',
                dataType: 'json',
                data: {
                    'id': '{{$user->id}}'
                },
                success: document.getElementById('btn-upload-reset').click()
            })
        })

        $('#btn-upload-reset').on("click", function() {
            $('#btn-remove').attr('hidden', 'hidden');
            $('#display').removeAttr('hidden');
            $('#btn-upload-result').removeAttr('hidden');
            $('#btn-upload-reset').removeAttr('hidden');
            $('.upload-photo').removeClass('ready');
            $('.upload-photo').removeClass('result');
            $("#display-i").html('');
            $('#upload').val('');
        });

        let $uploadCrop;

        function readFile(input) {
            if (input.files && input.files[0]) {
                if (/^image/.test(input.files[0].type)) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $('.upload-photo').addClass('ready');
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        }).then(function() {
                            // console.log('jQuery bind complete');
                        });
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert("You may only select image files");
                }
            } else {
                alert("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        $uploadCrop = $('#display').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            },
        });

        function popupResult(result) {
            let html = '<img src="' + result.src + '" />';
            $("#display-i").html(html);
        }

        $('#upload').on('change', function() {
            readFile(this);
        });

        $('#btn-upload-result').on('click', function(ev) {
            let fileInput = document.getElementById('upload');
            let fileName = fileInput.files[0].name;
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                $.ajax({
                    url: '/image-crop',
                    type: 'PATCH',
                    dataType: 'json',
                    data: {
                        'image': resp,
                        'name': fileName,
                        'id': '{{$user->id}}',
                    },
                    success: function(data) {
                        $('#btn-upload-result').attr('hidden', 'hidden');
                        $('#display').attr('hidden', 'hidden');
                        $('.upload-photo').addClass('result');
                        popupResult({
                            src: resp
                        });
                    }
                });
            });
        });
    });
</script>
