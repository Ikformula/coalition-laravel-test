<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | Coalition Tech Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
<div class="container mt-4">
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <div id="alert-div">

            </div>
        </div>
    </div>
    @yield('content')

</div>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
        crossorigin="anonymous"></script>
<script>
    function disableSubmit(){
        $('#submit').addClass('disabled').attr('disabled', true).html('Processing');
    }

    function enableSubmit(){
        $('#submit').removeClass('disabled').attr('disabled', false).html('Submit');
    }

</script>
@stack('after-scripts')

</body>
</html>
