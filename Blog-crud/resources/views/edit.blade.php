<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Edit Blog</title>
</head>
<body class="bg-gray-500">
    <header>
        @include('navbar')
    </header>

    <section class="flex flex-col items-center m-2">
        <div class="bg-gray-600 border-2 w-2/3 p-2 border-black rounded">
            <form class="flex flex-col" method="post" action="/updatepost">
                <input name="postid" type="hidden" id="postid" value='{{$id}}'>
                <h1 class="text-white text-center">Edit Blog</h1>
                <p class="text-white">Title</p>
                <input name="title" class="rounded w-60 border-black p-1" type="text" placeholder="Title" value='{{$post['title']}}'>
                <p class="text-white">Category</p>
                <select name="category" class="rounded w-60 border-black p-1">
                    <option value='{{$post['category']}}' selected hidden>{{$post['category']}}</option>
                    @foreach ($categorys as $item => $value)
                    <option id='{{$value["name"]}}BTN' value='{{$value["name"]}}'>{{$value['name']}}</option>
                    @endforeach
                </select>
                <p class="text-white">Content</p>
                <textarea name="content" class="rounded h-60 border-black p-1" type="text" placeholder="Content">{{$post['content']}}</textarea>
                <div class="flex flex-col items-center mt-2">
    	    	<button type="submit" name="submit" value="submit" class="transition-all duration-300 bg-blue-600 rounded p-2 hover:bg-blue-700">Submit</button>
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