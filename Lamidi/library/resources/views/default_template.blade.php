<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Example</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @foreach ($css_files as $css_file)
    <link rel="stylesheet" href="{{ $css_file }}">
    @endforeach
</head>

<body>
    <div style="padding: 20px">
        {!! $output !!}
    </div>

    @foreach ($js_files as $js_file)
    <script src="{{ $js_file }}"></script>
    @endforeach
    <script>
        if (typeof $ !== 'undefined') {
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        }
    </script>
</body>

</html>