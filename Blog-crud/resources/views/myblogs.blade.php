<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>My Blogs</title>
    <script src="{{ asset('js/main.js')}}"></script>
</head>
<body class="bg-gray-500">
    <header>
        @include('navbar')
        
    </header>

    <section class="flex flex-col text-white">
        <h1 class="text-white font-bold text-3xl m-5" >Blogs</h1>
        {{-- <p>results: {{$response['blogAmount']}}</p>  --}}
        <div class="flex flex-row">
            <form class="flex flex-row" id="searchForm" method="GET" action="">
                <div class="flex">
                    <p class="m-2" >Category: </p>
                    @foreach ($categorys as $item => $value)
                    <label id='{{$value["name"]}}LBL' class=" bg-blue-500 m-2 p-2 rounded transition-all duration-300 hover:bg-blue-700">{{$value['name']}}
                        <input type="checkbox" id='{{$value["name"]}}BTN' onchange="updateSelectedCategory(this)" name='{{$value["name"]}}' class="">
                    </label>
                    @endforeach
                </div>
    
                <input id="searchbar" class="rounded m-2 text-black" name="search" type="search" placeholder="Search blog" >
                <button id="searchBTN" type="submit" value="search" class="m-1 transition-all duration-300 bg-green-600 rounded p-2 hover:bg-green-700" >Search</button>
                {{-- @csrf --}}
                <meta name="_token" content="{{ csrf_token() }}">
            </form>
        </div>
    </section>

    <main class="flex flex-row">
        @foreach ($posts as $item => $value)
        @if ($value['user_id'] == session()->get('uuid'))
        <div class="m-2 bg-white rounded border-2 border-black p-2">
            <p class="text-2xl">{{$value['title']}}</p>
            <p>{{$value['content']}}</p>
            <a href="{{ route('details', ['id' => $value['id']] ) }}"><button class="p-2 m-1 transition-all duration-300 bg-blue-500 hover:bg-blue-700 rounded text-white">Details</button></a>
            <a href="{{ route('editpost', ['id'=> $value['id']] ) }}"><button class="p-2 m-1 transition-all duration-300 bg-orange-500 hover:bg-orange-700 rounded text-white">Edit</button></a>
            <a href="{{ route('deletepost', ['id' => $value['id']] ) }}"><button class="p-2 m-1 transition-all duration-300 bg-red-500 hover:bg-red-700 rounded text-white">delete</button></a>
        </div>
        @endif
        @endforeach
    </main>
</body>
</html>