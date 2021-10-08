
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- include semua file asset blanjaloka --}}
    <link rel="shortcut icon" href="http://accounting.com.my/wp-content/uploads/2016/08/buy_logo1.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('assets/blanjaloka/css/blanjaloka.css')}}">
    <script src="{{asset('assets/blanjaloka/js/blanjaloka.js')}}"></script>
    <title>{{$title}} | Blanjaloka</title>
  </head>

  <body style="overflow-x: hidden;">

    {{-- include navbar file --}}
    @include('web/partition/navbar')

    {{-- Rendering halaman dinamis  --}}
    @yield('content')
    
    {{-- include footer file --}}
    @include('web/partition/footer')
  </body>
</html>