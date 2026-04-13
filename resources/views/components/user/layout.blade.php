<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products Management System</title>
</head>
<body>

    <header>
        <h1>Product Management System</h1>
        <nav>
            <ul>

                @guest
                    <li><a href="{{ url('/userForm') }}">Register | Log In</a></li>
                @endguest
                
                @auth
                    <li><a href="{{ url('/') }}">Products</a></li>
                    {{-- To DO: Display Avatar Image and Name --}}
                    <li><a href="{{ url('/me') }}"> <img src="{{ Auth::user()->avatar ? asset('public/avatars/' . Auth::user()->avatar) : asset('public/avatars/placeholder.jpg')}}" width="100" alt="Image">{{ Auth::user()->name}}</a></li>
                    <li><a href="#" onclick= "event.preventDefault();document.getElementById('userLogout').submit()">Logout</a></li>
                @endauth

              
            </ul>
        </nav>

        <form action="{{ url('/userLogout') }}" method="POST" id="userLogout">
            @csrf
        </form>
    </header>


    <main>
        {{ $slot }}
    </main>
   

    
</body>
</html>