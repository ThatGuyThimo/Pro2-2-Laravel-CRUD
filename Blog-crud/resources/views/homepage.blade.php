<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Homepage</title>
</head>
<body class="bg-gray-500">
    <header>
        <div class="flex flex-row-reverse items-stretch bg-[#333333]">
            <ul class="text-white p-2 flex">
                <a href="/" class="hover:text-gray-400 mr-2 " ><li><img src="resources/images/GS.svg"></li></a>
                <a href="/" class="hover:text-gray-400 mr-2 " ><li>Home</li></a>
                <a href="/login" class="hover:text-gray-400 mr-2 " ><li>Login</li></a>
                <a href="/blogs" class="hover:text-gray-400 mr-2 " > <li>Blogs</li></a>
                <a href="/favorites" class="hover:text-gray-400 mr-2 " ><li>Favorites</li></a>
            </ul>
        </div>
    </header> 
</body>
</html>