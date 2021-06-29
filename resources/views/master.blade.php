<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <title>Employees list!</title>
</head>
<body>

<div class="wrapper mt-5">
    @yield('content')
</div>



<script>
     const $perPageSelect = document.getElementById('perPageSelect');
     $perPageSelect.addEventListener('change', function () {
         window.location.replace(this.value);
     })
</script>


</body>
</html>
