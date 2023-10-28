
<div class="flex flex-row items-stretch bg-[#333333]">
    <ul class="text-white p-2 flex">
        <a href="/" class="hover:text-gray-400 mr-2 " ><li><img width="60px" src="{{ asset('/images/GS.svg') }}"></li></a>
        @if (session()->has('username')) 
        <a href="/logout" class="hover:text-gray-400 mr-2 " ><li>Logout</li></a>
        <a href="/favorites" class="hover:text-gray-400 mr-2 " ><li>Favorites</li></a>
        <a href="/createblog" class="hover:text-gray-400 mr-2 " ><li>Create blog</li></a>
        <a href="/myposts" class="hover:text-gray-400 mr-2 " ><li>My blogs</li></a>
        @else
        <a href="/login" class="hover:text-gray-400 mr-2 " ><li>Login</li></a>
        @endif
        <a href="/blogs" class="hover:text-gray-400 mr-2 " > <li>Blogs</li></a>
    </ul>
</div>