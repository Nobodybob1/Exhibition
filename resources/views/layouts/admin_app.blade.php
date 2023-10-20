<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izložba</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    {{-- <header>
        <h1>Welcome to the Exhibition App</h1>
    </header> --}}
    <nav>
        <ul>
            <li><a href="/admin">Home</a></li>
            <li><a href="/admin_artists">Artists</a></li>
            <li><a href="/admin_arts">Arts</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </nav>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer>
        &copy; {{ date('Y') }} Exhibition App
    </footer>
    
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
{{-- <script>
    $(document).ready(function() {
        $('#message-alert').fadeIn('slow');
        setTimeout(function() {
            $('#message-alert').fadeOut('slow');
        }, 1000); // 5 seconds
    });
</script> --}}

</body>
</html>
