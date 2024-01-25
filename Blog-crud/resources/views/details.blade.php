<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{$post['title']}}</title>
    <script defer src="{{ asset('js/main.js')}}"></script>
</head>
<body class="bg-gray-500">
    <header>
        @include('navbar')
        
    </header>

    <main class="flex flex-row">
        <div class="m-2 bg-white rounded border-2 border-black p-2">
            <p class="text-2xl">{{$post['title']}}</p>
            <p class="text-sm">Category {{$post['category']}}</p>
            @if($post['status'] == 0)
            <p class="text-sm">Status enabled</p>
            @else
            <p class="text-sm">Status disabled</p>
            @endif
            <p>{{$post['content']}}</p>
            <p class="text-sm">Published on: {{$post['created_at']}}</p>
            <p class="text-sm">Updated on: {{$post['updated_at']}}</p>
            @if ($post['user_id'] == session()->get('uuid')|| session()->get('level') == 1)
                <a href="{{ route('editpost', ['id' => $post['id']]) }}"><button class="p-2 m-1 transition-all duration-300 bg-orange-500 hover:bg-orange-700 rounded text-white">Edit</button></a>
                <a href="{{ route('deletepost', ['id' => $post['id']]) }}"><button class="p-2 m-1 transition-all duration-300 bg-red-500 hover:bg-red-700 rounded text-white">delete</button></a>
                @if (session()->get('level') == 1)
                    @if ($post['status'] == 0) 
                        <a href="{{ route('togglepost', ['id' => $post['id']]) }}"><button class="p-2 m-1 transition-all duration-300 bg-blue-500 hover:bg-blue-700 rounded text-white">disable</button></a>
                    @else
                    <a href="{{ route('togglepost', ['id' => $post['id']]) }}"><button class="p-2 m-1 transition-all duration-300 bg-blue-500 hover:bg-blue-700 rounded text-white">enable</button></a>
                    @endif
                @endif
                {{-- <a href="/editpost?id={{$post['id']}}"><button class="p-2 m-1 transition-all duration-300 bg-orange-500 hover:bg-orange-700 rounded text-white">Edit</button></a>
                <a href="/deletepost?id={{$post['id']}}"><button class="p-2 m-1 transition-all duration-300 bg-red-500 hover:bg-red-700 rounded text-white">delete</button></a> --}}
            @endif
        </div>
    </main>
</body>
</html>