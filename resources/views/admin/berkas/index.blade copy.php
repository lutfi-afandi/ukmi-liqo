<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form URL</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <form id="form-url" method="POST">
        <input type="text" name="url_file" id="url_file" style="font-size: 12px; padding: 2px; width: 400px">
        <button id="btn-submit">Simpan</button>
    </form>

    <div id="link-baru"></div>

    <iframe id="frame" src="" frameborder="0" width="100%" height="480px"></iframe>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Set CSRF token in the header for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#form-url').submit(function(e) {
                e.preventDefault(); // Prevent form from submitting the default way
                var url_file = $('#url_file').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.berkas.store') }}",
                    data: {
                        url_file: url_file
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#link-baru').html(response.link_baru);
                        $('#url_file').val('');
                        $('#frame').attr('src', response.link_baru);
                    },
                    error: function(xhr, status, error) {
                        console.log("An error occurred: " + status + " " + error);
                    }
                });
            });
        });
    </script>
</body>

</html>
