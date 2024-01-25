<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Register</title>
</head>
<body class="bg-gray-500">
    <header>
        @include('navbar')
    </header>

    <section class="flex flex-col items-center m-2">
        <div class="bg-gray-600 border-2 p-2 border-black rounded">
            <form class="flex flex-col" method="post" action="{{ route('registeruser') }}">
                <h1 class="text-white text-center">Register</h1>
                <p class="text-white">Name</p>
                <input name="username" class="rounded border-black p-1" type="text" placeholder="Name">
                <p class="text-white">Email</p>
                <input name="email" class="rounded border-black p-1" type="Email" placeholder="Email">
                <p class="text-white">Password</p>
                <input name="password" class="rounded border-black p-1" type="Password" placeholder="Password">
                <div class="flex flex-col items-center mt-2">
                    <div class="" >
                        <a class="text-white hover:text-gray-300" href="{{ route('login') }}">Login<a>
                        <button type="submit" name="register" value="register" class="transition-all duration-300 bg-blue-600 rounded p-2 hover:bg-blue-700">Register</button>
                    </div>
                </div>
                @csrf
            </form>
            @if(isset($error))
            <div class="text-center">
                <p class="text-red-500">{{$error}}</p>
            </div>
            @endif
        </div>
    </section>
</body>
</html>